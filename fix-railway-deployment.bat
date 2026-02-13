@echo off
REM Railway Deployment Fix Script for Windows
REM Run this locally before pushing to Railway

echo 🚀 Fixing Railway Deployment Issues...
echo.

REM 1. Clear all caches
echo 📦 Clearing caches...
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

REM 2. Optimize for production
echo ⚡ Optimizing for production...
php artisan config:cache
php artisan route:cache
php artisan view:cache

REM 3. Discover Livewire components
echo 🔍 Discovering Livewire components...
php artisan livewire:discover

REM 4. Dump autoload
echo 📚 Dumping autoload...
composer dump-autoload

REM 5. Build assets
echo 🎨 Building assets...
call npm run build

echo.
echo ✅ All fixes applied!
echo.
echo 📝 Next steps:
echo 1. Commit and push changes to Railway
echo 2. Check Railway logs for any errors
echo 3. Test all Livewire functionality
echo.
echo 🔗 Your app URL: https://ingrentlicious-production.up.railway.app
echo.
pause
