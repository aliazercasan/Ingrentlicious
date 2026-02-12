# Ingrentlicious Recipe System

A friendly and knowledgeable recipe assistant built with Laravel, Livewire, and Volt.

## Features

### Guest Users
- ✅ View recipe titles
- ✅ View ingredients with quantities
- ✅ View step-by-step cooking instructions
- ❌ Cannot add, edit, or delete recipes

### Registered Users
- ✅ All guest user features
- ✅ Add new recipes with ingredients and instructions
- ✅ Edit their own recipes
- ✅ Delete their own recipes
- ✅ Recipes persist in MySQL database

## Tech Stack

- **Frontend**: Laravel Livewire with Volt components
- **Backend**: Laravel 11
- **Database**: MySQL
- **UI**: Tailwind CSS with Flux components

## Routes

- `GET /` - Welcome page
- `GET /recipes` - Browse all recipes (public)
- `GET /recipes/{recipe}` - View recipe details (public)
- `GET /recipes/create/new` - Add new recipe (auth required)
- `GET /recipes/{recipe}/edit` - Edit recipe (auth required, owner only)

## Database Structure

### recipes table
- id
- user_id (foreign key)
- title
- instructions (text)
- timestamps

### ingredients table
- id
- recipe_id (foreign key)
- name
- quantity (nullable)
- order (for sorting)
- timestamps

## Getting Started

1. Run migrations:
```bash
php artisan migrate
```

2. Seed sample data:
```bash
php artisan db:seed
```

3. Start the development server:
```bash
php artisan serve
```

4. Visit http://localhost:8000

## Sample Account

- Email: chef@ingrentlicious.com
- Password: password

## Authorization

The system uses Laravel Policies to enforce:
- Anyone can view recipes (guests and registered users)
- Only authenticated users can create recipes
- Only recipe owners can edit/delete their own recipes
