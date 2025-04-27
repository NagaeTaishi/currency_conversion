FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libsqlite3-dev \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock

RUN composer config -g process-timeout 3600
RUN composer install --no-autoloader
