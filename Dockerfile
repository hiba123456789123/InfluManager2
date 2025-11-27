# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    git \
    unzip \
    && docker-php-ext-install sockets

# Installer la dernière version stable de l'extension MongoDB
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copier le projet dans le conteneur
WORKDIR /var/www/html
COPY . .

# Copier Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Exposer le port Apache
EXPOSE 80
