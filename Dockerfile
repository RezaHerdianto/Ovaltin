FROM php:8.2-cli

# System deps + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Node.js 20 for Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Install PHP deps
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install JS deps & build assets (Vite)
RUN npm ci && npm run build

# ✅ Fix Laravel cache paths + permissions (anti error "valid cache path")
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Run Laravel via PHP built-in server (Railway listens on 8080)
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
