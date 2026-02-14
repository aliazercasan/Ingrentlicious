#!/bin/bash

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Rebuild assets
npm run build

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Seed recipes if needed
php artisan recipes:seed --no-interaction || true

echo "Deployment complete!"
