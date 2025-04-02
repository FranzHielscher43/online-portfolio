FROM php:8.2-apache

# Aktiviert mod_rewrite (nützlich bei späteren Features)
RUN a2enmod rewrite

# Optional: mysqli aktivieren, falls du es brauchst
RUN docker-php-ext-install mysqli