FROM php:fpm
WORKDIR /app
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    libpq-dev\
    zip \
    curl \
    && docker-php-ext-install\
    pdo pdo_pgsql pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html/
RUN cd /var/www/html && \
    composer install --prefer-dist --no-dev --no-scripts --no-progress --no-suggest --optimize-autoloader

RUN composer require cboden/ratchet
