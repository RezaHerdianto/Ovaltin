# 1) Build assets Vite (Node 22 biar aman sama vite/laravel-vite-plugin)
FROM node:22-alpine AS node_build
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# 2) PHP runtime
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader

# ✅ bawa hasil build vite (manifest.json ada di sini)
COPY --from=node_build /app/public/build /app/public/build

RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
