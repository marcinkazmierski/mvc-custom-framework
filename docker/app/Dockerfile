FROM php:8.0-apache

COPY php/php.ini /usr/local/etc/php/

# Dependencies
RUN apt-get update && apt-get install -y git zip unzip curl openssh-server nano libc-client-dev libkrb5-dev
RUN apt-get install -y libpng-dev
RUN docker-php-ext-install pdo pdo_mysql gd

RUN a2enmod rewrite
RUN service apache2 restart

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

