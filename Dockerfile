FROM php:7.3-cli

ENV COMPOSER_HASH "76a7060ccb93902cd7576b67264ad91c8a2700e2"

RUN apt-get update \
  && apt-get install -y wget \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && wget https://raw.githubusercontent.com/composer/getcomposer.org/${COMPOSER_HASH}/web/installer -O - -q | php -- --quiet \
  && mv composer.phar /usr/bin/composer \
  && mkdir -p /var/www/.composer/cache/repo/https \
  && mkdir -p /var/www/.composer/cache/files \
  && chown -R www-data:www-data /var/www/.composer \
  && rm -rf /var/lib/apt/lists/*
