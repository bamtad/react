FROM php:fpm
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends \
    libpq-dev && pecl install imagick && docker-php-ext-enable imagick && docker-php-ext-install pdo pdo_pgsql pgsql

COPY policy.xml /etc/ImageMagick-6/policy.xml