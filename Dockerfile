FROM richarvey/nginx-php-fpm:latest

COPY . .

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

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1



CMD ["/start.sh"]