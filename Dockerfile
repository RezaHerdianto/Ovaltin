FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY package.json package-lock.json ./
RUN npm ci && npm run build

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
