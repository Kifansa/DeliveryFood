FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip sockets

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --prefer-dist --no-dev --optimize-autoloader

COPY nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 9000 80

CMD service nginx start && php-fpm
