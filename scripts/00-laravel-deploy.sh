#!/usr/bin/env bash
set -e

echo "🧬 Running migrations..."
php artisan migrate --force

echo "✅ Deploy script complete!"
