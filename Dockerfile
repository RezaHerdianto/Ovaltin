FROM php:8.2-cli

# System dependencies + PHP extensions (GD, PDO, etc.)
RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Node.js (for Vite build)
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

# Install & build frontend (Vite)
RUN npm ci && npm run build

# Create required Laravel cache directories (fix: "Please provide a valid cache path")
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Start server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
