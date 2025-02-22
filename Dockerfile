FROM php:8.3-apache-bookworm AS php
ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# PHP Extensions install
# hadolint ignore=DL3008
RUN apt-get update && apt-get install -y libicu-dev nano  zip unzip --no-install-recommends  \
    && rm -r /var/lib/apt/lists/*


FROM php AS php-with-security-update
#Update CVE package
# hadolint ignore=DL3008
RUN apt-get update  \
    && apt-get upgrade -y \
    && rm -r /var/lib/apt/lists/*

FROM php-with-security-update AS php-with-composer
# add env COMPOSER_ALLOW_SUPERUSER = 1 if composer >= 2.7 - error: usage with root user leads to plugins not being loaded
# hadolint ignore=DL3022
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

FROM php-with-composer AS php-conf

#https://github.com/docker-library/docs/blob/master/php/README.md#configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# Add custom config to PHP
COPY ./docker_file/php/custom-config.ini "$PHP_INI_DIR/conf.d/custom-config.ini"
COPY ./docker_file/php/custom-prod.ini "$PHP_INI_DIR/conf.d/custom-prod.ini"
COPY ./docker_file/apache/apache-cfg.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker_file/apache/site.conf /etc/apache2/sites-available/site.conf
RUN sed 's/80/8080/g' -i /etc/apache2/sites-available/000-default.conf \
    && echo 'Listen 8080' > /etc/apache2/ports.conf \
    && a2ensite 000-default.conf && a2enmod rewrite \
    && usermod -u 1000 www-data

FROM php-conf AS php-with-code
# Copy all(without .dockerignore) file to image
COPY --chown=www-data:www-data ./ /var/www/html/
WORKDIR /var/www/html/

FROM php-with-composer  AS php-dev

# Enable apache rewrite
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
# Add custom config to PHP
COPY ./docker_file/php/custom-config.ini "$PHP_INI_DIR/conf.d/custom-config.ini"
COPY ./docker_file/apache/apache-cfg-dev.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker_file/apache/site.conf /etc/apache2/sites-available/site.conf
RUN mkdir "/etc/apache2/ssl/"
COPY ./docker_file/apache/ssl.crt /etc/apache2/ssl/ssl.crt
COPY ./docker_file/apache/ssl.key /etc/apache2/ssl/ssl.key
#a2enmod headers <- especially for iframe because session don't work by default in iframe and why must edit header Header edit Set-Cookie ^(.*)$ $1;Secure;SameSite=None
RUN a2ensite 000-default.conf && a2enmod rewrite && a2enmod ssl && a2enmod headers

# Add user and copy project
RUN usermod -u 1000 www-data

FROM php-with-code AS php-ci
# TODO add ci scripts
RUN echo -1