<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        $user = User::factory()->create([
            'name' => 'Chef Maria',
            'email' => 'chef@ingrentlicious.com',
        ]);

        // Create sample recipes
        $chocolateChipCookies = $user->recipes()->create([
            'title' => 'Classic Chocolate Chip Cookies',
            'instructions' => "Step 1: Preheat your oven to 375°F (190°C).\n\nStep 2: In a large bowl, cream together the butter and sugars until light and fluffy.\n\nStep 3: Beat in the eggs one at a time, then stir in the vanilla extract.\n\nStep 4: In a separate bowl, whisk together flour, baking soda, and salt.\n\nStep 5: Gradually blend the dry ingredients into the butter mixture.\n\nStep 6: Fold in the chocolate chips.\n\nStep 7: Drop rounded tablespoons of dough onto ungreased cookie sheets.\n\nStep 8: Bake for 9-11 minutes or until golden brown.\n\nStep 9: Cool on baking sheet for 2 minutes before removing to a wire rack.",
        ]);

        $chocolateChipCookies->ingredients()->createMany([
            ['name' => 'All-purpose flour', 'quantity' => '2 1/4 cups', 'order' => 0],
            ['name' => 'Baking soda', 'quantity' => '1 tsp', 'order' => 1],
            ['name' => 'Salt', 'quantity' => '1 tsp', 'order' => 2],
            ['name' => 'Butter, softened', 'quantity' => '1 cup', 'order' => 3],
            ['name' => 'Granulated sugar', 'quantity' => '3/4 cup', 'order' => 4],
            ['name' => 'Brown sugar', 'quantity' => '3/4 cup', 'order' => 5],
            ['name' => 'Eggs', 'quantity' => '2 large', 'order' => 6],
            ['name' => 'Vanilla extract', 'quantity' => '2 tsp', 'order' => 7],
            ['name' => 'Chocolate chips', 'quantity' => '2 cups', 'order' => 8],
        ]);

        $spaghettiCarbonara = $user->recipes()->create([
            'title' => 'Authentic Spaghetti Carbonara',
            'instructions' => "Step 1: Bring a large pot of salted water to boil and cook spaghetti according to package directions.\n\nStep 2: While pasta cooks, cut pancetta into small cubes and fry in a large skillet until crispy.\n\nStep 3: In a bowl, whisk together eggs, Parmesan cheese, and black pepper.\n\nStep 4: Reserve 1 cup of pasta water, then drain the spaghetti.\n\nStep 5: Remove skillet from heat and add hot pasta to the pancetta.\n\nStep 6: Quickly pour in the egg mixture, tossing constantly to create a creamy sauce.\n\nStep 7: Add pasta water a little at a time if needed to reach desired consistency.\n\nStep 8: Serve immediately with extra Parmesan and black pepper.",
        ]);

        $spaghettiCarbonara->ingredients()->createMany([
            ['name' => 'Spaghetti', 'quantity' => '1 lb', 'order' => 0],
            ['name' => 'Pancetta or guanciale', 'quantity' => '6 oz', 'order' => 1],
            ['name' => 'Large eggs', 'quantity' => '4', 'order' => 2],
            ['name' => 'Parmesan cheese, grated', 'quantity' => '1 cup', 'order' => 3],
            ['name' => 'Black pepper, freshly ground', 'quantity' => '1 tsp', 'order' => 4],
            ['name' => 'Salt', 'quantity' => 'to taste', 'order' => 5],
        ]);

        $avocadoToast = $user->recipes()->create([
            'title' => 'Perfect Avocado Toast',
            'instructions' => "Step 1: Toast your bread slices until golden and crispy.\n\nStep 2: While bread toasts, cut avocado in half and remove the pit.\n\nStep 3: Scoop avocado flesh into a bowl and mash with a fork.\n\nStep 4: Add lemon juice, salt, and pepper to the mashed avocado and mix well.\n\nStep 5: Spread the avocado mixture generously on the toasted bread.\n\nStep 6: Top with cherry tomatoes, red pepper flakes, and a drizzle of olive oil.\n\nStep 7: Optional: Add a poached egg on top for extra protein.\n\nStep 8: Serve immediately and enjoy!",
        ]);

        $avocadoToast->ingredients()->createMany([
            ['name' => 'Bread slices', 'quantity' => '2', 'order' => 0],
            ['name' => 'Ripe avocado', 'quantity' => '1', 'order' => 1],
            ['name' => 'Lemon juice', 'quantity' => '1 tbsp', 'order' => 2],
            ['name' => 'Salt', 'quantity' => 'to taste', 'order' => 3],
            ['name' => 'Black pepper', 'quantity' => 'to taste', 'order' => 4],
            ['name' => 'Cherry tomatoes, halved', 'quantity' => '1/4 cup', 'order' => 5],
            ['name' => 'Red pepper flakes', 'quantity' => 'pinch', 'order' => 6],
            ['name' => 'Olive oil', 'quantity' => '1 tsp', 'order' => 7],
        ]);

        // Create additional users with recipes
        $user2 = User::factory()->create([
            'name' => 'John Baker',
            'email' => 'john@example.com',
        ]);

        $pancakes = $user2->recipes()->create([
            'title' => 'Fluffy Pancakes',
            'instructions' => "Step 1: Mix flour, sugar, baking powder, and salt in a bowl.\n\nStep 2: In another bowl, whisk milk, egg, and melted butter.\n\nStep 3: Pour wet ingredients into dry and stir until just combined.\n\nStep 4: Heat griddle over medium heat and grease lightly.\n\nStep 5: Pour 1/4 cup batter for each pancake.\n\nStep 6: Cook until bubbles form, then flip.\n\nStep 7: Cook until golden brown on both sides.",
        ]);

        $pancakes->ingredients()->createMany([
            ['name' => 'All-purpose flour', 'quantity' => '1 1/2 cups', 'order' => 0],
            ['name' => 'Sugar', 'quantity' => '2 tbsp', 'order' => 1],
            ['name' => 'Baking powder', 'quantity' => '2 tsp', 'order' => 2],
            ['name' => 'Salt', 'quantity' => '1/2 tsp', 'order' => 3],
            ['name' => 'Milk', 'quantity' => '1 1/4 cups', 'order' => 4],
            ['name' => 'Egg', 'quantity' => '1 large', 'order' => 5],
            ['name' => 'Butter, melted', 'quantity' => '3 tbsp', 'order' => 6],
        ]);

        $user3 = User::factory()->create([
            'name' => 'Sarah Green',
            'email' => 'sarah@example.com',
        ]);

        $greekSalad = $user3->recipes()->create([
            'title' => 'Greek Salad',
            'instructions' => "Step 1: Chop cucumbers, tomatoes, and bell peppers into chunks.\n\nStep 2: Slice red onion thinly.\n\nStep 3: Combine vegetables in a large bowl.\n\nStep 4: Add olives and feta cheese.\n\nStep 5: Drizzle with olive oil and lemon juice.\n\nStep 6: Season with oregano, salt, and pepper.\n\nStep 7: Toss gently and serve.",
        ]);

        $greekSalad->ingredients()->createMany([
            ['name' => 'Cucumbers', 'quantity' => '2 large', 'order' => 0],
            ['name' => 'Tomatoes', 'quantity' => '3 medium', 'order' => 1],
            ['name' => 'Bell pepper', 'quantity' => '1', 'order' => 2],
            ['name' => 'Red onion', 'quantity' => '1/2', 'order' => 3],
            ['name' => 'Kalamata olives', 'quantity' => '1/2 cup', 'order' => 4],
            ['name' => 'Feta cheese', 'quantity' => '4 oz', 'order' => 5],
            ['name' => 'Olive oil', 'quantity' => '3 tbsp', 'order' => 6],
            ['name' => 'Lemon juice', 'quantity' => '2 tbsp', 'order' => 7],
            ['name' => 'Dried oregano', 'quantity' => '1 tsp', 'order' => 8],
        ]);

        // Create more random users and recipes
        User::factory(5)->create()->each(function ($user) {
            // Each user gets 2-4 random recipes
            $recipeCount = rand(2, 4);
            
            for ($i = 0; $i < $recipeCount; $i++) {
                $recipe = $user->recipes()->create([
                    'title' => fake()->randomElement([
                        'Grilled Salmon',
                        'Vegetable Soup',
                        'Chicken Curry',
                        'Beef Stew',
                        'Mushroom Risotto',
                        'Shrimp Scampi',
                        'Lasagna',
                        'Pad Thai',
                        'French Toast',
                        'Brownies',
                    ]),
                    'instructions' => "Step 1: Prepare all ingredients.\n\nStep 2: Follow cooking method.\n\nStep 3: Season to taste.\n\nStep 4: Cook until done.\n\nStep 5: Serve hot and enjoy!",
                ]);

                // Add 3-6 ingredients per recipe
                $ingredientCount = rand(3, 6);
                for ($j = 0; $j < $ingredientCount; $j++) {
                    $recipe->ingredients()->create([
                        'name' => fake()->randomElement([
                            'Chicken breast',
                            'Olive oil',
                            'Garlic',
                            'Onion',
                            'Salt',
                            'Pepper',
                            'Tomatoes',
                            'Cheese',
                            'Pasta',
                            'Rice',
                            'Vegetables',
                            'Herbs',
                        ]),
                        'quantity' => fake()->randomElement([
                            '1 cup',
                            '2 cups',
                            '1 lb',
                            '2 tbsp',
                            '1 tsp',
                            'to taste',
                            '1/2 cup',
                            '3 cloves',
                        ]),
                        'order' => $j,
                    ]);
                }
            }
        });
    }
}
