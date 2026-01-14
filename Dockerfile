FROM php:8.2-cli

# System deps
RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Node.js for Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Build Vite (fail if build fails)
RUN npm ci && npm run build || (echo "Vite build failed!" && exit 1)

# ✅ Verify build output exists and show contents
RUN echo "=== Checking build output ===" && \
    ls -la public/ && \
    (test -d public/build && echo "✓ Build directory exists" || echo "✗ Build directory missing") && \
    (test -f public/build/manifest.json && echo "✓ Manifest.json exists" || echo "✗ Manifest.json missing") && \
    cat public/build/manifest.json 2>/dev/null || echo "Cannot read manifest.json"

# ✅ Ensure Laravel runtime dirs exist
RUN mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    public/build

# ✅ Permission
RUN chown -R www-data:www-data storage bootstrap/cache public/build \
 && chmod -R 775 storage bootstrap/cache \
 && chmod -R 755 public/build

# ✅ Clear caches (biar gak nyangkut cache lama)
RUN php artisan config:clear || true \
 && php artisan cache:clear || true \
 && php artisan view:clear || true

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
