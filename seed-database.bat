@echo off
REM Database Seeding Script for Windows
REM This script will seed your database with 25 international recipes

echo.
echo ========================================
echo   Database Seeding Script
echo ========================================
echo.
echo This will add 25 recipes to your database:
echo - 5 Japanese recipes
echo - 5 Korean recipes
echo - 5 Filipino recipes
echo - 5 Italian recipes
echo - 5 Mexican recipes
echo.

set /p confirm="Do you want to continue? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo.
    echo Seeding cancelled.
    pause
    exit /b
)

echo.
echo 🌱 Starting database seeding...
echo.

REM Fresh migration (optional - uncomment if you want to reset database)
REM echo 🔄 Resetting database...
REM php artisan migrate:fresh
REM echo.

echo 📦 Running seeders...
php artisan db:seed --class=RecipeDataSeeder

if %errorlevel% equ 0 (
    echo.
    echo ✅ Database seeded successfully!
    echo.
    echo 📊 Summary:
    echo    - 25 recipes created
    echo    - Multiple ingredients per recipe
    echo    - Random view counts assigned
    echo.
    echo 🔗 You can now view the recipes at:
    echo    http://127.0.0.1:8000/recipes
    echo.
) else (
    echo.
    echo ❌ Error: Seeding failed!
    echo Please check the error messages above.
    echo.
)

pause
