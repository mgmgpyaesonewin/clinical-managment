FROM php:7.4.21-fpm-alpine

RUN mkdir -p /var/www/html

RUN apk --no-cache add shadow && usermod -u 1000 www-data

RUN set -ex \
    && apk --no-cache add \
    postgresql-dev \
    libpng-dev

RUN docker-php-ext-install pdo pdo_pgsql gd

RUN chown -R www-data:www-data /var/www/html

RUN chmod -R 755 /var/www/html/storage
