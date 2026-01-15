FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        mbstring \
        zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN npm install && npm run build


# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-interaction

# Expose port for Railway
EXPOSE 8080

# Run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
