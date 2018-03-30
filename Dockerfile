FROM php:7.2.3-fpm-alpine

ENV PATH /drupal/vendor/bin:$PATH

RUN apk update \
 && apk add --virtual .phpize-deps ${PHPIZE_DEPS} \
 && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
 && apk add libmemcached zlib cyrus-sasl \
 && pecl install igbinary-2.0.5 \
 && apk add --virtual .php-ext-memcached-deps libmemcached-dev zlib-dev cyrus-sasl-dev \
 && pecl bundle memcached-3.0.4 \
 && rm memcached-3.0.4.tgz \
 && cd memcached \
 && phpize \
 && ./configure --enable-memcached-igbinary \
 && make -j${NPROC} \
 && make install \
 && cd .. \
 && rm -r memcached \
 && apk add freetype libpng libjpeg-turbo \
 && apk add --virtual .php-ext-gd-deps freetype-dev libpng-dev libjpeg-turbo-dev \
 && docker-php-ext-configure gd \
    --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j${NPROC} gd pdo pdo_mysql \
 && docker-php-ext-enable igbinary memcached opcache \
 && apk del .phpize-deps .php-ext-gd-deps .php-ext-memcached-deps \
 && rm -rf /var/cache/apk/*

WORKDIR /drupal

RUN curl -fSL "https://github.com/hechoendrupal/drupal-console-launcher/releases/download/1.8.0/drupal.phar" -o /usr/local/bin/drupal && chmod +x /usr/local/bin/drupal

RUN apk --no-cache add mysql-client

COPY php.ini /usr/local/etc/php/
