#!/bin/bash

# Railway Deployment Fix Script
# Run this locally before pushing to Railway

echo "🚀 Fixing Railway Deployment Issues..."

# 1. Clear all caches
echo "📦 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 2. Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Discover Livewire components
echo "🔍 Discovering Livewire components..."
php artisan livewire:discover

# 4. Dump autoload
echo "📚 Dumping autoload..."
composer dump-autoload

# 5. Build assets
echo "🎨 Building assets..."
npm run build

echo "✅ All fixes applied!"
echo ""
echo "📝 Next steps:"
echo "1. Commit and push changes to Railway"
echo "2. Check Railway logs for any errors"
echo "3. Test all Livewire functionality"
echo ""
echo "🔗 Your app URL: https://ingrentlicious-production.up.railway.app"
