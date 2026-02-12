# Ingrentlicious Quick Start

## 🚀 Get Started in 3 Steps

### 1. Database Setup
The database is already migrated and seeded! If you need to reset:
```bash
php artisan migrate:fresh --seed
```

### 2. Start the Server
```bash
php artisan serve
```

### 3. Visit the App
Open your browser to: **http://localhost:8000**

## 🎯 What to Try

### As a Guest
1. Click "Browse Recipes" on the homepage
2. Click any recipe to see full details
3. Notice you can't add/edit recipes

### As a Registered User
1. Click "Register" and create an account
2. Go to Recipes and click "Add Recipe"
3. Create your first recipe!
4. Edit or delete your recipes

### Use Sample Account
- Email: `chef@ingrentlicious.com`
- Password: `password`

This account owns the 3 sample recipes.

## 📁 Key Files

- **Routes**: `routes/web.php`
- **Models**: `app/Models/Recipe.php`, `app/Models/Ingredient.php`
- **Views**: `resources/views/livewire/recipes/`
- **Policy**: `app/Policies/RecipePolicy.php`

## 🎨 Features

✅ Browse recipes (public)
✅ View recipe details (public)
✅ Add recipes (authenticated)
✅ Edit your recipes (owner only)
✅ Delete your recipes (owner only)
✅ Dynamic ingredient management
✅ Loading states & skeletons
✅ Dark mode support
✅ Mobile responsive

## 📚 Documentation

- Full details: `INGRENTLICIOUS.md`
- Testing guide: `TESTING_GUIDE.md`
- Implementation: `IMPLEMENTATION_SUMMARY.md`

## 🐛 Troubleshooting

Clear caches if you see errors:
```bash
php artisan view:clear
php artisan config:clear
php artisan route:clear
```

---

**Happy Cooking! 🍳**
