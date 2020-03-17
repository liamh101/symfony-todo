FROM composer:latest as vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install

FROM node:latest as frontend

COPY assets/ assets/
COPY package.json package.json
COPY yarn.lock yarn.lock
COPY webpack.config.js webpack.config.js
COPY .env .env
COPY .env.local .env.local

RUN yarn install
RUN yarn run dev
RUN ls public/build

FROM php:7.4.3-fpm
RUN pecl install xdebug-2.9.2 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/symfony
COPY --from=vendor /app/vendor /var/www/symfony/vendor
COPY --from=frontend public/build /var/www/symfony/public/build
WORKDIR /var/www/symfony

ENTRYPOINT ["/var/www/symfony/docker/php/entrypoint.sh"]