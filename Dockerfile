# Use PHP base image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev libzip-dev \
    gnupg2 ca-certificates

# Install Node.js via NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Verify installation
RUN node -v && npm -v

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Set permissions early
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Pre-install dependencies (only run once during image build)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Copy deploy script
COPY scripts/00-laravel-deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Ensure runtime write permissions for Laravel
RUN mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views && \
    mkdir -p /var/www/html/storage/logs && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Final CMD — run script and then start PHP-FPM
EXPOSE 8080

CMD ["/bin/bash", "-c", "/usr/local/bin/deploy.sh && php artisan serve --host=0.0.0.0 --port=8080"]