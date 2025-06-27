#!/usr/bin/env bash
set -e

echo "📦 Running composer..."
composer install --no-dev --working-dir=/var/www/html

echo "⚙️ Caching config..."
php artisan config:cache

--- Install Node.js and npm for Alpine Linux ---
# Alpine uses 'apk' for package management.
# 'nodejs' and 'npm' are often in the 'community' repository,
# so ensure that's enabled if you encounter issues.
RUN apk add --no-cache nodejs npm && \
    rm -rf /var/cache/apk/* 

# Verify Node.js and npm installation (optional, but good for debugging build logs)
RUN node -v && npm -v


echo "📁 Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "📦 Running npm install..."
npm install

echo "🛠 Running npm build..."
npm run build

echo "🚦 Caching routes..."
php artisan route:cache

echo "🧬 Running migrations..."
php artisan migrate --force

echo "✅ Deploy script complete!"
