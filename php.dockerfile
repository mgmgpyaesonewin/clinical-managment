FROM php:7.4.21-fpm-alpine

RUN mkdir -p /var/www/html

RUN apk --no-cache add shadow && usermod -u 1000 www-data

RUN set -ex \
    && apk --no-cache add \
    postgresql-dev \
    libpng-dev

RUN docker-php-ext-install pdo pdo_pgsql gd

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del pcre-dev ${PHPIZE_DEPS}

# RUN chown -R www-data:www-data *
