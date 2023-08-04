FROM php:8.2.6-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

# TODO: in container I have no name! but create file by OK username permission
USER 1000:1000

WORKDIR /var/www
