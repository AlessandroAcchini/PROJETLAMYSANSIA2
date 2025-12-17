
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activer le module de réécriture d'Apache
RUN a2enmod rewrite

# Copier le code source de l'application dans le conteneur
COPY ./ ./var/www/html

# Exposer le port 80
EXPOSE 80
