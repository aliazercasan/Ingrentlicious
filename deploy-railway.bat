@echo off
echo Deploying to Railway...
echo.
echo Step 1: Adding changes to git...
git add .
echo.
echo Step 2: Committing changes...
git commit -m "Update APP_URL for Railway deployment"
echo.
echo Step 3: Pushing to Railway...
git push origin main
echo.
echo Deployment initiated! Railway will automatically rebuild.
echo.
echo IMPORTANT: After deployment, run these commands in Railway console:
echo   php artisan config:clear
echo   php artisan cache:clear
echo   php artisan view:clear
echo.
pause
