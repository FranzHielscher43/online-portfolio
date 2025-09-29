FROM php:8.2-apache

# Composer installieren
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Aktiviert mod_rewrite (nützlich bei späteren Features)
RUN a2enmod rewrite

# Optional: mysqli aktivieren, falls du es brauchst
RUN docker-php-ext-install mysqli