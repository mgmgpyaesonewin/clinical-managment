FROM composer:1.10.8

RUN set -ex \
    && apk --no-cache add \
    libpng-dev

RUN docker-php-ext-install gd
