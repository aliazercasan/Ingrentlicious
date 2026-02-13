# Manual Seeding on Railway

If the automatic seeding didn't work on Railway, follow these steps to manually seed your database.

## Option 1: Using Railway CLI (Recommended)

### Step 1: Install Railway CLI
```bash
npm install -g @railway/cli
```

### Step 2: Login to Railway
```bash
railway login
```

### Step 3: Link to Your Project
```bash
railway link
```
Select your project: `ingrentlicious-production`

### Step 4: Run the Seeder
```bash
railway run php artisan db:seed --class=RecipeDataSeeder --force
```

### Step 5: Verify
```bash
railway run php artisan tinker --execute="echo App\Models\Recipe::count();"
```

## Option 2: Using Railway Dashboard

### Step 1: Open Railway Dashboard
Go to: https://railway.app/dashboard

### Step 2: Select Your Project
Click on `ingrentlicious-production`

### Step 3: Open Shell
1. Click on your service
2. Click on "Settings" tab
3. Scroll down to "Service Settings"
4. Click "Open Shell" or use the terminal icon

### Step 4: Run Commands
```bash
php artisan db:seed --class=RecipeDataSeeder --force
```

### Step 5: Verify
```bash
php artisan tinker --execute="echo App\Models\Recipe::count();"
```

## Option 3: Temporary Route (Quick Fix)

Add this route temporarily to seed via browser:

1. Edit `routes/web.php` and add:
```php
Route::get('/seed-now', function () {
    if (app()->environment('production')) {
        Artisan::call('db:seed', ['--class' => 'RecipeDataSeeder', '--force' => true]);
        return 'Seeded! Total recipes: ' . \App\Models\Recipe::count();
    }
    return 'Only works in production';
})->middleware('auth');
```

2. Deploy to Railway

3. Visit: `https://your-app.up.railway.app/seed-now`

4. **IMPORTANT:** Remove this route after seeding!

## Troubleshooting

### Issue: "Class RecipeDataSeeder not found"
```bash
railway run composer dump-autoload
railway run php artisan db:seed --class=RecipeDataSeeder --force
```

### Issue: "User already exists"
This is normal. The seeder uses `firstOrCreate` so it won't duplicate the user.

### Issue: Recipes duplicating
If you run the seeder multiple times, recipes will duplicate. To prevent this:

```bash
# Clear all data and reseed
railway run php artisan migrate:fresh --seed --force
```

### Issue: Can't see recipes on the site
1. Make sure you're logged out or using a different account
2. Check if recipes exist:
```bash
railway run php artisan tinker --execute="echo App\Models\Recipe::count();"
```

## Verify Seeding Success

After seeding, check:

1. **Recipe count:**
```bash
railway run php artisan tinker --execute="echo App\Models\Recipe::count();"
```
Should return: 25 (or more if you had existing recipes)

2. **List recipes:**
```bash
railway run php artisan tinker --execute="App\Models\Recipe::take(5)->get(['title'])->each(function(\$r) { echo \$r->title . PHP_EOL; });"
```

3. **Check on website:**
- Visit: https://ingrentlicious-production.up.railway.app/recipes
- You should see 25 international recipes

## Default Login

After seeding, you can login with:
- **Email:** chef@ingrentlicious.com
- **Password:** password

## Need Help?

If you're still having issues:
1. Check Railway logs for errors
2. Verify database connection
3. Ensure migrations ran successfully
4. Check if the RecipeDataSeeder.php file was deployed

---

**Note:** The seeder is safe to run multiple times, but it will create duplicate recipes. If you want to avoid duplicates, clear the database first with `migrate:fresh`.
