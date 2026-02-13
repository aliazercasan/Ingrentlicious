# 🍳 Ingrentlicious - Database Seeding

## What's Included

This project includes **25 authentic international recipes** ready to populate your database:

### 🇯🇵 Japanese (5 recipes)
- Chicken Teriyaki
- Traditional Miso Soup
- Homemade Ramen
- California Roll Sushi
- Crispy Vegetable Tempura

### 🇰🇷 Korean (5 recipes)
- Bibimbap (Mixed Rice Bowl)
- Kimchi Jjigae (Kimchi Stew)
- Korean Fried Chicken
- Japchae (Glass Noodles)
- Tteokbokki (Spicy Rice Cakes)

### 🇵🇭 Filipino (5 recipes)
- Chicken Adobo
- Sinigang na Baboy (Sour Soup)
- Lumpia Shanghai (Spring Rolls)
- Pancit Canton (Stir-Fried Noodles)
- Lechon Kawali (Crispy Pork Belly)

### 🇮🇹 Italian (5 recipes)
- Spaghetti Carbonara
- Margherita Pizza
- Lasagna Bolognese
- Risotto alla Milanese
- Tiramisu

### 🇲🇽 Mexican (5 recipes)
- Tacos al Pastor
- Chicken Enchiladas
- Guacamole
- Chiles Rellenos
- Pozole Rojo

## Quick Start

### Local Development

**Windows:**
```bash
test-seeder.bat
```

**Direct command:**
```bash
php artisan db:seed --class=RecipeDataSeeder --force
```

### Railway Deployment

**Method 1: Automatic (on deploy)**
- Seeding runs automatically when you deploy to Railway
- Check Railway logs to verify

**Method 2: Manual via route**
1. Deploy your code
2. Login to your app
3. Visit: `https://your-app.up.railway.app/admin/seed-database`
4. Remove the route after seeding

**Method 3: Railway CLI**
```bash
railway run php artisan db:seed --class=RecipeDataSeeder --force
```

## Files Overview

### Seeder Files
- `database/seeders/RecipeDataSeeder.php` - Main seeder with all 25 recipes
- `database/seeders/DatabaseSeeder.php` - Calls RecipeDataSeeder

### Scripts
- `test-seeder.bat` - Test seeding locally (Windows)
- `seed-database.bat` - Interactive seeding script (Windows)
- `seed-database.sh` - Interactive seeding script (Linux/Mac)

### Documentation
- `QUICK_FIX_GUIDE.md` - ⭐ Start here for Railway issues
- `RAILWAY_MANUAL_SEED.md` - Detailed Railway seeding guide
- `DATABASE_SEEDING_GUIDE.md` - Complete seeding documentation
- `README_SEEDING.md` - This file

## Default User

The seeder creates one user account:
- **Email:** chef@ingrentlicious.com
- **Password:** password
- **Name:** Chef Maria

All 25 recipes belong to this user.

## Verification

After seeding, verify with:

```bash
# Check recipe count
php artisan tinker --execute="echo App\Models\Recipe::count();"

# List some recipes
php artisan tinker --execute="App\Models\Recipe::take(5)->pluck('title')->each(function(\$t) { echo \$t . PHP_EOL; });"
```

## Troubleshooting

### No recipes showing on Railway?
👉 Read `QUICK_FIX_GUIDE.md`

### Seeder not running?
👉 Read `RAILWAY_MANUAL_SEED.md`

### Want to understand everything?
👉 Read `DATABASE_SEEDING_GUIDE.md`

## Support

If you're having issues:
1. Check Railway logs
2. Verify database connection
3. Ensure migrations ran
4. Try manual seeding via CLI

---

**Happy Cooking! 🍳**
