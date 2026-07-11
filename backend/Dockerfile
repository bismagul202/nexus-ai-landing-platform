FROM php:8.2-apache

# System dependencies install karein
RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip

# PHP extensions install karein
RUN docker-php-ext-install pdo_mysql gd zip

# Apache document root update karein
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Composer install karein
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Dependencies install karein
RUN composer install --no-dev --optimize-autoloader

# Permissions set karein
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
