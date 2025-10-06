FROM php:8.2-apache

WORKDIR /var/www/html

# Composer aus dem offiziellen Composer-Image kopieren
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Apache mod_rewrite aktivieren
RUN a2enmod rewrite

# mysqli aktivieren
RUN docker-php-ext-install mysqli

# Composer-Abhängigkeiten installieren
# composer.json und composer.lock müssen im Projektstamm liegen
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Website-Dateien kopieren
COPY public/ ./public/