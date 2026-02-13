@echo off
cls
echo.
echo ========================================
echo   Quick Recipe Seeding
echo ========================================
echo.
echo This will seed 25 international recipes
echo.

php artisan recipes:seed --fresh

echo.
echo ========================================
echo   Done!
echo ========================================
echo.
echo Visit: http://127.0.0.1:8000/recipes
echo.
pause
