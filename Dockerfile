FROM php:8.2-fpm

# PHP uzantı bağımlılıklarını yükle
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

# Çalışma dizinini ayarla
COPY . /var/www/app
WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage

# Composer'ı yükle
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer

# composer.json'u çalışma dizinine kopyala ve bağımlılıkları yükle
COPY composer.json ./
RUN composer install

# Varsayılan komut olarak php-fpm'i ayarla
CMD ["sh", "-c", "php artisan migrate --seed --force && php-fpm"]
