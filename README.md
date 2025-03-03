# Simple Symfony web app that searches for cities

## Stack
- Symfony 6.4
- Docker
- PHP 8.3
- PHPUnit 12
- <b>Automatic quality tools:</b> php-cs-fixer, phpstan


## How to run
- `cp .env .env.local`
- fill in APP_SECRET to `.env.local`
- `cp docker-compose.override-sample.yml docker-compose.override.yml`
- adjust docker ports
- `docker compose up -d`
- connect to docker service
- `composer install`
- open `https://localhost:xyz/` -> xyz is your port from docker-compose.override.yml

---
- run tests -> `php bin/phpunit tests`
- run php-cs-fixer `php vendor/bin/php-cs-fixer fix src/`
- run phpstan `php vendor/bin/phpstan`
