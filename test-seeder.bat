@echo off
echo Testing Database Seeder...
echo.

echo Step 1: Checking current recipe count...
php artisan tinker --execute="echo 'Current recipes: ' . App\Models\Recipe::count() . PHP_EOL;"
echo.

echo Step 2: Running seeder...
php artisan db:seed --class=RecipeDataSeeder --force
echo.

echo Step 3: Checking new recipe count...
php artisan tinker --execute="echo 'Total recipes: ' . App\Models\Recipe::count() . PHP_EOL;"
echo.

echo Step 4: Listing some recipes...
php artisan tinker --execute="App\Models\Recipe::latest()->take(5)->get(['id', 'title'])->each(function($r) { echo $r->id . ': ' . $r->title . PHP_EOL; });"
echo.

echo Done!
pause
