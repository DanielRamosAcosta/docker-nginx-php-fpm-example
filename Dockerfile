# Use intermediate container to install dependencies
FROM php:7.3-alpine AS builder

WORKDIR /app

RUN apk update \
 && apk add git unzip \
 && curl https://getcomposer.org/download/1.8.5/composer.phar --output /usr/bin/composer \
 && chmod u+x /usr/bin/composer

COPY ./composer.json composer.json
COPY ./composer.lock composer.lock

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize

# Copy dependencies into the final PHP FPM container
FROM php:7.3-fpm-alpine

RUN mkdir -p /var/www/html/storage \
 && mkdir -p /var/www/html/bootstrap/cache \
 && chown -R www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY --from=builder /app /var/www/html
