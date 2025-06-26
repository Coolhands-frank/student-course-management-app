# Use the richarvey/nginx-php-fpm image
# You can specify a tag for a specific PHP version if needed, e.g., richarvey/nginx-php-fpm:php8.2-latest
FROM richarvey/nginx-php-fpm:latest

# Set the working directory inside the container
WORKDIR /var/www/html

# --- Install Node.js and npm ---
# The richarvey image is based on Debian/Ubuntu.
# We'll use NodeSource for a robust Node.js installation.
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs && \
    npm install -g npm@latest && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Verify Node.js and npm installation (optional, but good for debugging build logs)
RUN node -v && npm -v

# --- Copy Application Files ---
# Copy your entire application code into the container
COPY . .

# --- Set Permissions ---
# Laravel needs proper permissions for storage and bootstrap/cache directories
# The richarvey image typically runs as `www-data`, so assign ownership to it.
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# --- Install PHP Dependencies (Composer) ---
# Install Composer dependencies, skipping development packages for production
RUN composer install --no-dev --optimize-autoloader

# --- Build Frontend Assets ---
# Now that Node.js and npm are installed, build your assets.
# This assumes your package.json has a 'build' script (e.g., for Vite, Webpack, Mix)
RUN npm install && npm run build

# --- Copy Custom Nginx Configuration ---
# IMPORTANT: The richarvey image often places its default configs in /etc/nginx/sites-enabled/.
# Overwriting the default.conf or adding a new one is common.
# Ensure your `nginx-site.conf` is located at `conf/nginx/nginx-site.conf` in your local project.
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default.conf

# Ensure the PHP-FPM socket path in your nginx-site.conf matches what richarvey uses.
# The richarvey image commonly uses `unix:/var/run/php-fpm.sock`, which aligns with your provided config.

# --- Expose Port ---
# Nginx typically listens on port 80. Render will forward traffic to this.
EXPOSE 80

# --- Define the container's entrypoint/command ---
# The richarvey image has a robust entrypoint that automatically starts Nginx and PHP-FPM.
# You typically don't need a custom CMD unless you have specific pre-startup scripts.
# If you had a deploy script, it might look like this:
# COPY scripts/00-laravel-deploy.sh /usr/local/bin/deploy.sh
# RUN chmod +x /usr/local/bin/deploy.sh
# CMD ["/usr/local/bin/deploy.sh", "&&", "nginx", "-g", "daemon off;", "&&", "php-fpm"]
# However, for richarvey, its default CMD is usually sufficient.
# Let's keep it simple and rely on the base image's entrypoint.
# CMD ["/usr/local/bin/docker-entrypoint.sh"] # This is often the default CMD for richarvey

# If you had a specific deploy script you *must* run before the server starts,
# and it doesn't fit the richarvey entrypoint, you could override CMD:
# CMD ["/bin/bash", "-c", "/usr/local/bin/deploy.sh && /usr/local/bin/docker-entrypoint.sh"]
# But for most cases with richarvey, just copying your app and config is enough.