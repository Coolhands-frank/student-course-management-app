#!/usr/bin/env bash
set -e

echo "⚙️ Caching config..."
php artisan config:cache

echo "📁 Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "🚦 Caching routes..."
php artisan route:cache

echo "🧬 Running migrations..."
php artisan migrate --force

echo "✅ Deploy script complete!"
