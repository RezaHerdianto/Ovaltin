FROM php:8.2-cli

# ===============================
# System dependencies
# ===============================
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
    && rm -rf /var/lib/apt/lists/*

# ===============================
# Install Node.js + npm (WAJIB)
# ===============================
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm --version \
    && node --version

# ===============================
# Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# ===============================
# Copy project
# ===============================
COPY . .

# ===============================
# Install PHP deps
# ===============================
RUN composer install \
    --no-interaction \
    --optimize-autoloader \
    --no-dev

# ===============================
# Build Vite (INI YANG BIKIN manifest.json)
# ===============================
RUN npm install && npm run build

# ===============================
# Laravel permissions
# ===============================
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
