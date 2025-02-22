# Simple Symfony web app that searches for cities

## Stack
- Symfony 6.4
- Docker
- PHP 8.3
- PHPUnit 12

## How to run:
- `cp docker-compose.override-sample.yml docker-compose.override.yml`
- adjust docker ports
- `cp .env .env.local`
- `docker compose up -d`
- connect to docker service
- `composer install`
- run tests -> `php bin/phpunit tests`
