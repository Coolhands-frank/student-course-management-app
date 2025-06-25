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

# Install Composer (from official Composer image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy your Laravel project files
COPY . .

# Install PHP & JS dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Laravel permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]

COPY scripts/00-laravel-deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh
CMD ["sh", "/usr/local/bin/deploy.sh"]