# Ingrentlicious Testing Guide

## Quick Start

1. **Start the development server:**
```bash
php artisan serve
```

2. **Visit the application:**
- Homepage: http://localhost:8000
- Recipes: http://localhost:8000/recipes

## Test Scenarios

### As a Guest User

1. **Browse Recipes**
   - Go to http://localhost:8000/recipes
   - You should see 3 sample recipes (Chocolate Chip Cookies, Spaghetti Carbonara, Avocado Toast)
   - Notice the blue banner prompting you to register/login

2. **View Recipe Details**
   - Click on any recipe card
   - You should see:
     - Recipe title
     - Author name
     - Ingredients list with quantities
     - Step-by-step instructions
   - Notice you DON'T see Edit/Delete buttons (not the owner)

3. **Try to Add Recipe (Should Redirect)**
   - Click "Login to Add Recipe" button
   - Should redirect to login page

### As a Registered User

1. **Register a New Account**
   - Click "Register" in the header
   - Fill in your details
   - Complete registration

2. **Add a New Recipe**
   - Go to http://localhost:8000/recipes
   - Click "Add Recipe" button
   - Fill in:
     - Recipe Title: "My Test Recipe"
     - Ingredients: Add at least 2 ingredients with quantities
     - Instructions: Add step-by-step instructions
   - Click "Save Recipe"
   - Should redirect to the recipe detail page

3. **Edit Your Recipe**
   - On your recipe detail page, click "Edit"
   - Modify the title, ingredients, or instructions
   - Click "Update Recipe"
   - Changes should be saved

4. **Delete Your Recipe**
   - On your recipe detail page, click "Delete"
   - Confirm the deletion
   - Should redirect back to recipes list

5. **Try to Edit Someone Else's Recipe**
   - View one of Chef Maria's recipes
   - Notice you DON'T see Edit/Delete buttons (authorization working)

### Using Sample Account

Login with:
- Email: chef@ingrentlicious.com
- Password: password

You'll be able to edit/delete the 3 sample recipes.

## Expected Behaviors

### Loading States
- When navigating between pages, you should see skeleton loaders
- Forms show "Saving..." or "Updating..." during submission

### Authorization
- Guests can view but not create/edit/delete
- Users can only edit/delete their own recipes
- Attempting unauthorized actions should fail gracefully

### Validation
- Recipe title is required
- At least 1 ingredient is required
- Instructions are required
- Ingredient names are required (quantity is optional)

## Troubleshooting

If you see errors:

1. **Clear caches:**
```bash
php artisan view:clear
php artisan config:clear
php artisan route:clear
```

2. **Re-run migrations:**
```bash
php artisan migrate:fresh --seed
```

3. **Check database connection:**
- Ensure your .env file has correct database settings
- Default is SQLite (database/database.sqlite)
