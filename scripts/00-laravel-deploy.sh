#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "creating write location"
touch touch /tmp/database.sqlite

echo "Running npm"
npm install 

echo "Running npm build"
npm run build

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force 

