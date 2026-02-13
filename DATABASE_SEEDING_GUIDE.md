# Database Seeding Guide

## Overview

This project includes a comprehensive database seeder with 25 international recipes from 5 different cuisines.

## Recipe Collection

### Japanese Recipes (5)
1. Chicken Teriyaki
2. Traditional Miso Soup
3. Homemade Ramen
4. California Roll Sushi
5. Crispy Vegetable Tempura

### Korean Recipes (5)
1. Bibimbap (Mixed Rice Bowl)
2. Kimchi Jjigae (Kimchi Stew)
3. Korean Fried Chicken
4. Japchae (Glass Noodles)
5. Tteokbokki (Spicy Rice Cakes)

### Filipino Recipes (5)
1. Chicken Adobo
2. Sinigang na Baboy (Sour Soup)
3. Lumpia Shanghai (Spring Rolls)
4. Pancit Canton (Stir-Fried Noodles)
5. Lechon Kawali (Crispy Pork Belly)

### Italian Recipes (5)
1. Spaghetti Carbonara
2. Margherita Pizza
3. Lasagna Bolognese
4. Risotto alla Milanese
5. Tiramisu

### Mexican Recipes (5)
1. Tacos al Pastor
2. Chicken Enchiladas
3. Guacamole
4. Chiles Rellenos
5. Pozole Rojo

## Local Development

### Method 1: Using the Seeding Script (Recommended)

**Windows:**
```bash
seed-database.bat
```

**Linux/Mac:**
```bash
chmod +x seed-database.sh
./seed-database.sh
```

### Method 2: Using Artisan Command

```bash
php artisan db:seed --class=RecipeDataSeeder
```

### Method 3: Fresh Migration with Seeding

If you want to reset your database completely:

```bash
php artisan migrate:fresh --seed
```

## Railway Deployment

### Automatic Seeding

The seeder runs automatically on Railway deployment thanks to the `nixpacks.toml` configuration:

```toml
[start]
cmd = 'php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}'
```

### Manual Seeding on Railway

If you need to manually seed the database on Railway:

1. **Install Railway CLI:**
   ```bash
   npm i -g @railway/cli
   ```

2. **Login to Railway:**
   ```bash
   railway login
   ```

3. **Link to your project:**
   ```bash
   railway link
   ```

4. **Run the seeder:**
   ```bash
   railway run php artisan db:seed --class=RecipeDataSeeder
   ```

### Reseed on Railway

To clear and reseed the database:

```bash
railway run php artisan migrate:fresh --seed --force
```

## Seeder Details

### User Account

The seeder creates a default user account:
- **Email:** chef@ingrentlicious.com
- **Password:** password
- **Name:** Chef Maria

All 25 recipes are associated with this user.

### Recipe Structure

Each recipe includes:
- Title
- Step-by-step instructions
- 4-10 ingredients with quantities
- Random view count (50-500)
- Proper ingredient ordering

### Database Tables

The seeder populates:
- `users` table (1 user)
- `recipes` table (25 recipes)
- `ingredients` table (~125-250 ingredients)

## Verification

After seeding, verify the data:

### Check Recipe Count
```bash
php artisan tinker
>>> App\Models\Recipe::count()
# Should return 25
```

### Check User's Recipes
```bash
php artisan tinker
>>> App\Models\User::where('email', 'chef@ingrentlicious.com')->first()->recipes()->count()
# Should return 25
```

### View in Browser

Visit your application:
- Local: http://127.0.0.1:8000/recipes
- Railway: https://your-app.up.railway.app/recipes

## Troubleshooting

### Error: "Class RecipeDataSeeder does not exist"

Run:
```bash
composer dump-autoload
php artisan db:seed --class=RecipeDataSeeder
```

### Error: "SQLSTATE[23000]: Integrity constraint violation"

The user might already exist. Either:
1. Delete the existing user
2. Or modify the seeder to use a different email

### Error: "Database not found"

Ensure your database is set up:
```bash
php artisan migrate
```

### Seeder runs but no data appears

Check if seeder is being called:
```bash
php artisan db:seed --class=RecipeDataSeeder --verbose
```

## Customization

### Adding More Recipes

Edit `database/seeders/RecipeDataSeeder.php` and add to the `getRecipesData()` array:

```php
[
    'title' => 'Your Recipe Name',
    'instructions' => "Step 1: ...\nStep 2: ...",
    'ingredients' => [
        ['name' => 'Ingredient 1', 'quantity' => '1 cup', 'order' => 0],
        ['name' => 'Ingredient 2', 'quantity' => '2 tbsp', 'order' => 1],
    ],
],
```

### Changing the Default User

Modify the user creation in `RecipeDataSeeder.php`:

```php
$user = User::firstOrCreate(
    ['email' => 'your-email@example.com'],
    ['name' => 'Your Name', 'password' => bcrypt('your-password')]
);
```

### Running Specific Seeders

You can create additional seeders for different purposes:

```bash
php artisan make:seeder AdditionalRecipesSeeder
```

Then run it:
```bash
php artisan db:seed --class=AdditionalRecipesSeeder
```

## Production Considerations

### First Deployment

On first deployment to Railway, the seeder will run automatically and populate your database.

### Subsequent Deployments

The seeder uses `firstOrCreate` for the user, so it won't create duplicates. However, recipes will be duplicated on each deployment.

### Preventing Duplicate Recipes

To prevent duplicates, you can:

1. **Remove seeding from start command** after first deployment:
   ```toml
   [start]
   cmd = 'php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}'
   ```

2. **Or add a check in the seeder:**
   ```php
   if (Recipe::count() > 0) {
       $this->command->info('Recipes already exist. Skipping seeding.');
       return;
   }
   ```

## Testing

Test the seeder locally before deploying:

```bash
# Test on a fresh database
php artisan migrate:fresh
php artisan db:seed --class=RecipeDataSeeder

# Verify
php artisan tinker
>>> Recipe::count()
>>> Recipe::with('ingredients')->first()
```

## Support

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Railway logs in the dashboard
3. Verify database connection
4. Ensure migrations have run successfully

---

**Happy Cooking! 🍳**
