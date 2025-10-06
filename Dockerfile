FROM php:8.2-apache

WORKDIR /var/www/html

# Basis-Pakete und PHP-Extensions installieren
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    && docker-php-ext-install mysqli \
    && a2enmod rewrite

# Composer aus dem offiziellen Composer-Image kopieren
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Composer-Abhängigkeiten installieren
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Website-Dateien kopieren
COPY public/ ./public/