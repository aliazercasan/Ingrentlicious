<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SeedRecipes extends Command
{
    protected $signature = 'recipes:seed {--fresh : Clear existing recipes first}';
    protected $description = 'Seed the database with 25 international recipes';

    public function handle()
    {
        $this->info('🌱 Starting recipe seeding...');
        $this->newLine();

        if ($this->option('fresh')) {
            $this->warn('⚠️  Clearing existing recipes...');
            \App\Models\Recipe::query()->delete();
            \App\Models\Ingredient::query()->delete();
        }

        // Check if recipes already exist
        $existingCount = \App\Models\Recipe::count();
        if ($existingCount > 0 && !$this->option('fresh')) {
            if (!$this->confirm("You already have {$existingCount} recipes. Continue seeding (will add more)?")) {
                $this->info('Seeding cancelled.');
                return 0;
            }
        }

        // Create or get user
        $user = User::firstOrCreate(
            ['email' => 'chef@ingrentlicious.com'],
            [
                'name' => 'Chef Maria',
                'password' => bcrypt('password')
            ]
        );

        $this->info("✓ User: {$user->name} ({$user->email})");
        $this->newLine();

        // Seed recipes
        $this->info('📦 Creating recipes...');
        $bar = $this->output->createProgressBar(25);
        $bar->start();

        $recipes = $this->getRecipesData();
        foreach ($recipes as $recipeData) {
            $recipe = $user->recipes()->create([
                'title' => $recipeData['title'],
                'instructions' => $recipeData['instructions'],
                'views' => rand(50, 500),
            ]);

            $recipe->ingredients()->createMany($recipeData['ingredients']);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Summary
        $totalRecipes = \App\Models\Recipe::count();
        $totalIngredients = \App\Models\Ingredient::count();

        $this->info('✅ Seeding completed successfully!');
        $this->newLine();
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Recipes', $totalRecipes],
                ['Total Ingredients', $totalIngredients],
                ['User', $user->email],
            ]
        );

        $this->newLine();
        $this->info('🔗 View recipes at: ' . url('/recipes'));
        $this->info('🔐 Login with: chef@ingrentlicious.com / password');

        return 0;
    }

    private function getRecipesData(): array
    {
        return [
            // Japanese
            ['title' => 'Chicken Teriyaki', 'instructions' => "Step 1: Cut chicken thighs into bite-sized pieces.\nStep 2: Mix soy sauce, mirin, sake, and sugar.\nStep 3: Cook chicken until golden.\nStep 4: Add sauce and simmer.\nStep 5: Garnish and serve with rice.", 'ingredients' => [
                ['name' => 'Chicken thighs', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Soy sauce', 'quantity' => '4 tbsp', 'order' => 1],
                ['name' => 'Mirin', 'quantity' => '3 tbsp', 'order' => 2],
            ]],
            ['title' => 'Traditional Miso Soup', 'instructions' => "Step 1: Bring dashi stock to simmer.\nStep 2: Add tofu and wakame.\nStep 3: Dissolve miso paste.\nStep 4: Garnish with green onions.", 'ingredients' => [
                ['name' => 'Dashi stock', 'quantity' => '4 cups', 'order' => 0],
                ['name' => 'Miso paste', 'quantity' => '3 tbsp', 'order' => 1],
                ['name' => 'Silken tofu', 'quantity' => '200g', 'order' => 2],
            ]],
            ['title' => 'Homemade Ramen', 'instructions' => "Step 1: Prepare broth by simmering pork bones.\nStep 2: Cook noodles.\nStep 3: Prepare toppings.\nStep 4: Assemble and serve hot.", 'ingredients' => [
                ['name' => 'Ramen noodles', 'quantity' => '400g', 'order' => 0],
                ['name' => 'Pork bones', 'quantity' => '1 kg', 'order' => 1],
                ['name' => 'Soft-boiled eggs', 'quantity' => '4', 'order' => 2],
            ]],
            ['title' => 'California Roll Sushi', 'instructions' => "Step 1: Cook and season sushi rice.\nStep 2: Place nori on mat.\nStep 3: Add fillings and roll.\nStep 4: Cut into pieces.", 'ingredients' => [
                ['name' => 'Sushi rice', 'quantity' => '2 cups', 'order' => 0],
                ['name' => 'Nori sheets', 'quantity' => '4', 'order' => 1],
                ['name' => 'Avocado', 'quantity' => '2', 'order' => 2],
            ]],
            ['title' => 'Crispy Vegetable Tempura', 'instructions' => "Step 1: Slice vegetables.\nStep 2: Make batter.\nStep 3: Heat oil to 350°F.\nStep 4: Fry until crispy.", 'ingredients' => [
                ['name' => 'All-purpose flour', 'quantity' => '1 cup', 'order' => 0],
                ['name' => 'Sweet potato', 'quantity' => '1', 'order' => 1],
                ['name' => 'Broccoli', 'quantity' => '1 head', 'order' => 2],
            ]],

            // Korean
            ['title' => 'Bibimbap', 'instructions' => "Step 1: Cook rice.\nStep 2: Prepare vegetables.\nStep 3: Cook beef.\nStep 4: Fry eggs.\nStep 5: Arrange and serve with gochujang.", 'ingredients' => [
                ['name' => 'Cooked rice', 'quantity' => '4 cups', 'order' => 0],
                ['name' => 'Beef sirloin', 'quantity' => '200g', 'order' => 1],
                ['name' => 'Gochujang', 'quantity' => '4 tbsp', 'order' => 2],
            ]],
            ['title' => 'Kimchi Jjigae', 'instructions' => "Step 1: Sauté pork.\nStep 2: Add kimchi.\nStep 3: Add water and boil.\nStep 4: Add tofu and simmer.", 'ingredients' => [
                ['name' => 'Pork belly', 'quantity' => '300g', 'order' => 0],
                ['name' => 'Kimchi', 'quantity' => '2 cups', 'order' => 1],
                ['name' => 'Firm tofu', 'quantity' => '200g', 'order' => 2],
            ]],
            ['title' => 'Korean Fried Chicken', 'instructions' => "Step 1: Marinate chicken.\nStep 2: Make batter and fry.\nStep 3: Make sauce.\nStep 4: Toss and serve.", 'ingredients' => [
                ['name' => 'Chicken wings', 'quantity' => '1 kg', 'order' => 0],
                ['name' => 'Gochujang', 'quantity' => '3 tbsp', 'order' => 1],
                ['name' => 'Honey', 'quantity' => '3 tbsp', 'order' => 2],
            ]],
            ['title' => 'Japchae', 'instructions' => "Step 1: Soak noodles.\nStep 2: Stir-fry vegetables.\nStep 3: Cook beef.\nStep 4: Combine everything.", 'ingredients' => [
                ['name' => 'Sweet potato noodles', 'quantity' => '200g', 'order' => 0],
                ['name' => 'Beef sirloin', 'quantity' => '200g', 'order' => 1],
                ['name' => 'Sesame oil', 'quantity' => '3 tbsp', 'order' => 2],
            ]],
            ['title' => 'Tteokbokki', 'instructions' => "Step 1: Soak rice cakes.\nStep 2: Make sauce.\nStep 3: Boil and add rice cakes.\nStep 4: Simmer until thick.", 'ingredients' => [
                ['name' => 'Korean rice cakes', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Gochujang', 'quantity' => '3 tbsp', 'order' => 1],
                ['name' => 'Fish cakes', 'quantity' => '100g', 'order' => 2],
            ]],

            // Filipino
            ['title' => 'Chicken Adobo', 'instructions' => "Step 1: Marinate chicken.\nStep 2: Brown chicken.\nStep 3: Add marinade and simmer.\nStep 4: Reduce sauce and serve.", 'ingredients' => [
                ['name' => 'Chicken pieces', 'quantity' => '1 kg', 'order' => 0],
                ['name' => 'Soy sauce', 'quantity' => '1/2 cup', 'order' => 1],
                ['name' => 'White vinegar', 'quantity' => '1/3 cup', 'order' => 2],
            ]],
            ['title' => 'Sinigang na Baboy', 'instructions' => "Step 1: Boil pork ribs.\nStep 2: Add vegetables.\nStep 3: Add tamarind paste.\nStep 4: Season and serve.", 'ingredients' => [
                ['name' => 'Pork ribs', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Tamarind paste', 'quantity' => '2 tbsp', 'order' => 1],
                ['name' => 'Radish', 'quantity' => '1', 'order' => 2],
            ]],
            ['title' => 'Lumpia Shanghai', 'instructions' => "Step 1: Mix filling.\nStep 2: Wrap in lumpia wrappers.\nStep 3: Fry until golden.\nStep 4: Serve with sauce.", 'ingredients' => [
                ['name' => 'Ground pork', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Lumpia wrappers', 'quantity' => '25 pieces', 'order' => 1],
                ['name' => 'Carrots', 'quantity' => '1 cup', 'order' => 2],
            ]],
            ['title' => 'Pancit Canton', 'instructions' => "Step 1: Soak noodles.\nStep 2: Sauté aromatics.\nStep 3: Add chicken and vegetables.\nStep 4: Toss with noodles.", 'ingredients' => [
                ['name' => 'Canton noodles', 'quantity' => '400g', 'order' => 0],
                ['name' => 'Chicken breast', 'quantity' => '300g', 'order' => 1],
                ['name' => 'Cabbage', 'quantity' => '2 cups', 'order' => 2],
            ]],
            ['title' => 'Lechon Kawali', 'instructions' => "Step 1: Boil pork belly.\nStep 2: Dry and refrigerate.\nStep 3: Deep fry until crispy.\nStep 4: Chop and serve.", 'ingredients' => [
                ['name' => 'Pork belly', 'quantity' => '1 kg', 'order' => 0],
                ['name' => 'Bay leaves', 'quantity' => '3', 'order' => 1],
                ['name' => 'Salt', 'quantity' => '2 tbsp', 'order' => 2],
            ]],

            // Italian
            ['title' => 'Spaghetti Carbonara', 'instructions' => "Step 1: Cook spaghetti.\nStep 2: Fry pancetta.\nStep 3: Mix eggs and cheese.\nStep 4: Combine and serve.", 'ingredients' => [
                ['name' => 'Spaghetti', 'quantity' => '400g', 'order' => 0],
                ['name' => 'Pancetta', 'quantity' => '150g', 'order' => 1],
                ['name' => 'Eggs', 'quantity' => '4', 'order' => 2],
            ]],
            ['title' => 'Margherita Pizza', 'instructions' => "Step 1: Roll out dough.\nStep 2: Add sauce and mozzarella.\nStep 3: Bake at 475°F.\nStep 4: Add fresh basil.", 'ingredients' => [
                ['name' => 'Pizza dough', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Tomato sauce', 'quantity' => '1 cup', 'order' => 1],
                ['name' => 'Fresh mozzarella', 'quantity' => '250g', 'order' => 2],
            ]],
            ['title' => 'Lasagna Bolognese', 'instructions' => "Step 1: Make Bolognese sauce.\nStep 2: Make béchamel.\nStep 3: Layer everything.\nStep 4: Bake for 45 minutes.", 'ingredients' => [
                ['name' => 'Lasagna sheets', 'quantity' => '12', 'order' => 0],
                ['name' => 'Ground beef', 'quantity' => '500g', 'order' => 1],
                ['name' => 'Mozzarella', 'quantity' => '300g', 'order' => 2],
            ]],
            ['title' => 'Risotto alla Milanese', 'instructions' => "Step 1: Sauté onions.\nStep 2: Toast rice.\nStep 3: Add stock gradually.\nStep 4: Finish with butter and cheese.", 'ingredients' => [
                ['name' => 'Arborio rice', 'quantity' => '2 cups', 'order' => 0],
                ['name' => 'Chicken stock', 'quantity' => '6 cups', 'order' => 1],
                ['name' => 'Saffron threads', 'quantity' => '1 pinch', 'order' => 2],
            ]],
            ['title' => 'Tiramisu', 'instructions' => "Step 1: Make espresso.\nStep 2: Mix mascarpone cream.\nStep 3: Layer with ladyfingers.\nStep 4: Refrigerate 4 hours.", 'ingredients' => [
                ['name' => 'Ladyfinger cookies', 'quantity' => '24', 'order' => 0],
                ['name' => 'Mascarpone cheese', 'quantity' => '500g', 'order' => 1],
                ['name' => 'Espresso', 'quantity' => '2 cups', 'order' => 2],
            ]],

            // Mexican
            ['title' => 'Tacos al Pastor', 'instructions' => "Step 1: Marinate pork.\nStep 2: Grill until charred.\nStep 3: Chop and fill tortillas.\nStep 4: Top with pineapple and cilantro.", 'ingredients' => [
                ['name' => 'Pork shoulder', 'quantity' => '1 kg', 'order' => 0],
                ['name' => 'Achiote paste', 'quantity' => '3 tbsp', 'order' => 1],
                ['name' => 'Corn tortillas', 'quantity' => '12', 'order' => 2],
            ]],
            ['title' => 'Chicken Enchiladas', 'instructions' => "Step 1: Cook and shred chicken.\nStep 2: Fill tortillas.\nStep 3: Roll and place in dish.\nStep 4: Top with sauce and bake.", 'ingredients' => [
                ['name' => 'Chicken breast', 'quantity' => '500g', 'order' => 0],
                ['name' => 'Flour tortillas', 'quantity' => '8', 'order' => 1],
                ['name' => 'Enchilada sauce', 'quantity' => '2 cups', 'order' => 2],
            ]],
            ['title' => 'Guacamole', 'instructions' => "Step 1: Mash avocados.\nStep 2: Add lime juice.\nStep 3: Mix in tomatoes and onions.\nStep 4: Season and serve.", 'ingredients' => [
                ['name' => 'Ripe avocados', 'quantity' => '4', 'order' => 0],
                ['name' => 'Lime juice', 'quantity' => '2 tbsp', 'order' => 1],
                ['name' => 'Tomatoes', 'quantity' => '2', 'order' => 2],
            ]],
            ['title' => 'Chiles Rellenos', 'instructions' => "Step 1: Roast and peel peppers.\nStep 2: Stuff with cheese.\nStep 3: Dip in batter.\nStep 4: Fry until golden.", 'ingredients' => [
                ['name' => 'Poblano peppers', 'quantity' => '6', 'order' => 0],
                ['name' => 'Oaxaca cheese', 'quantity' => '300g', 'order' => 1],
                ['name' => 'Eggs', 'quantity' => '4', 'order' => 2],
            ]],
            ['title' => 'Pozole Rojo', 'instructions' => "Step 1: Boil pork until tender.\nStep 2: Add hominy.\nStep 3: Add red chili sauce.\nStep 4: Simmer and serve with toppings.", 'ingredients' => [
                ['name' => 'Pork shoulder', 'quantity' => '1 kg', 'order' => 0],
                ['name' => 'Hominy', 'quantity' => '2 cans', 'order' => 1],
                ['name' => 'Dried chili peppers', 'quantity' => '6', 'order' => 2],
            ]],
        ];
    }
}
