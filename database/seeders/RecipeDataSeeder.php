<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'chef@ingrentlicious.com'],
            ['name' => 'Chef Maria', 'password' => bcrypt('password')]
        );

        $recipes = $this->getRecipesData();

        foreach ($recipes as $recipeData) {
            $recipe = $user->recipes()->create([
                'title' => $recipeData['title'],
                'instructions' => $recipeData['instructions'],
                'views' => rand(50, 500),
            ]);

            $recipe->ingredients()->createMany($recipeData['ingredients']);
        }
    }

    private function getRecipesData(): array
    {
        return [
            // JAPANESE RECIPES (5)
            [
                'title' => 'Chicken Teriyaki',
                'instructions' => "Step 1: Cut chicken thighs into bite-sized pieces.\nStep 2: Mix soy sauce, mirin, sake, and sugar to make teriyaki sauce.\nStep 3: Heat oil in a pan over medium-high heat.\nStep 4: Cook chicken until golden brown.\nStep 5: Pour teriyaki sauce and simmer until thick.\nStep 6: Garnish with sesame seeds and green onions.\nStep 7: Serve with steamed rice.",
                'ingredients' => [
                    ['name' => 'Chicken thighs', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Soy sauce', 'quantity' => '4 tbsp', 'order' => 1],
                    ['name' => 'Mirin', 'quantity' => '3 tbsp', 'order' => 2],
                    ['name' => 'Sake', 'quantity' => '2 tbsp', 'order' => 3],
                    ['name' => 'Sugar', 'quantity' => '2 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Traditional Miso Soup',
                'instructions' => "Step 1: Bring dashi stock to a gentle simmer.\nStep 2: Cut tofu into small cubes.\nStep 3: Add wakame seaweed and let rehydrate.\nStep 4: Add tofu cubes.\nStep 5: Dissolve miso paste with hot stock.\nStep 6: Turn off heat and stir in miso.\nStep 7: Garnish with green onions.\nStep 8: Serve immediately.",
                'ingredients' => [
                    ['name' => 'Dashi stock', 'quantity' => '4 cups', 'order' => 0],
                    ['name' => 'Miso paste', 'quantity' => '3 tbsp', 'order' => 1],
                    ['name' => 'Silken tofu', 'quantity' => '200g', 'order' => 2],
                    ['name' => 'Dried wakame seaweed', 'quantity' => '2 tbsp', 'order' => 3],
                ],
            ],
            [
                'title' => 'Homemade Ramen',
                'instructions' => "Step 1: Prepare ramen broth by simmering pork bones for 4-6 hours.\nStep 2: Cook ramen noodles per package instructions.\nStep 3: Prepare toppings: soft-boiled eggs, chashu pork, nori.\nStep 4: Season broth with soy sauce and mirin.\nStep 5: Place noodles in bowls.\nStep 6: Ladle hot broth over noodles.\nStep 7: Arrange toppings.\nStep 8: Serve immediately.",
                'ingredients' => [
                    ['name' => 'Ramen noodles', 'quantity' => '400g', 'order' => 0],
                    ['name' => 'Pork bones', 'quantity' => '1 kg', 'order' => 1],
                    ['name' => 'Soy sauce', 'quantity' => '1/4 cup', 'order' => 2],
                    ['name' => 'Soft-boiled eggs', 'quantity' => '4', 'order' => 3],
                    ['name' => 'Chashu pork', 'quantity' => '200g', 'order' => 4],
                ],
            ],
            [
                'title' => 'California Roll Sushi',
                'instructions' => "Step 1: Cook and season sushi rice with vinegar.\nStep 2: Place nori on bamboo mat.\nStep 3: Spread rice evenly on nori.\nStep 4: Flip so rice is on bottom.\nStep 5: Add cucumber, avocado, and crab.\nStep 6: Roll tightly.\nStep 7: Coat with sesame seeds.\nStep 8: Cut into 8 pieces.\nStep 9: Serve with soy sauce and wasabi.",
                'ingredients' => [
                    ['name' => 'Sushi rice', 'quantity' => '2 cups', 'order' => 0],
                    ['name' => 'Nori sheets', 'quantity' => '4', 'order' => 1],
                    ['name' => 'Cucumber', 'quantity' => '1', 'order' => 2],
                    ['name' => 'Avocado', 'quantity' => '2', 'order' => 3],
                    ['name' => 'Imitation crab', 'quantity' => '200g', 'order' => 4],
                ],
            ],
            [
                'title' => 'Crispy Vegetable Tempura',
                'instructions' => "Step 1: Slice vegetables (sweet potato, broccoli, peppers).\nStep 2: Make batter with flour, cornstarch, egg, and ice water.\nStep 3: Heat oil to 350°F.\nStep 4: Dip vegetables in batter.\nStep 5: Fry until golden and crispy.\nStep 6: Drain on paper towels.\nStep 7: Serve with tentsuyu sauce.\nStep 8: Garnish with grated daikon.",
                'ingredients' => [
                    ['name' => 'All-purpose flour', 'quantity' => '1 cup', 'order' => 0],
                    ['name' => 'Cornstarch', 'quantity' => '2 tbsp', 'order' => 1],
                    ['name' => 'Sweet potato', 'quantity' => '1', 'order' => 2],
                    ['name' => 'Broccoli', 'quantity' => '1 head', 'order' => 3],
                    ['name' => 'Vegetable oil', 'quantity' => '4 cups', 'order' => 4],
                ],
            ],

            // KOREAN RECIPES (5)
            [
                'title' => 'Bibimbap (Mixed Rice Bowl)',
                'instructions' => "Step 1: Cook rice and keep warm.\nStep 2: Prepare vegetables: blanch spinach, sauté mushrooms.\nStep 3: Season vegetables with sesame oil.\nStep 4: Cook beef with soy sauce and garlic.\nStep 5: Fry eggs sunny-side up.\nStep 6: Arrange rice in bowls with toppings.\nStep 7: Place egg on top.\nStep 8: Serve with gochujang.\nStep 9: Mix before eating.",
                'ingredients' => [
                    ['name' => 'Cooked rice', 'quantity' => '4 cups', 'order' => 0],
                    ['name' => 'Beef sirloin', 'quantity' => '200g', 'order' => 1],
                    ['name' => 'Spinach', 'quantity' => '200g', 'order' => 2],
                    ['name' => 'Mushrooms', 'quantity' => '150g', 'order' => 3],
                    ['name' => 'Gochujang', 'quantity' => '4 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Kimchi Jjigae (Kimchi Stew)',
                'instructions' => "Step 1: Cut pork belly into pieces.\nStep 2: Sauté pork until browned.\nStep 3: Add kimchi and stir-fry.\nStep 4: Add water and bring to boil.\nStep 5: Add tofu and green onions.\nStep 6: Simmer for 15-20 minutes.\nStep 7: Season with soy sauce.\nStep 8: Serve hot with rice.",
                'ingredients' => [
                    ['name' => 'Pork belly', 'quantity' => '300g', 'order' => 0],
                    ['name' => 'Kimchi', 'quantity' => '2 cups', 'order' => 1],
                    ['name' => 'Firm tofu', 'quantity' => '200g', 'order' => 2],
                    ['name' => 'Water', 'quantity' => '3 cups', 'order' => 3],
                    ['name' => 'Gochugaru', 'quantity' => '1 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Korean Fried Chicken',
                'instructions' => "Step 1: Marinate chicken with ginger and garlic.\nStep 2: Make batter with flour and cornstarch.\nStep 3: Heat oil to 350°F.\nStep 4: Fry chicken until crispy.\nStep 5: Make sauce with gochujang, honey, and soy sauce.\nStep 6: Heat sauce until bubbling.\nStep 7: Toss chicken in sauce.\nStep 8: Garnish with sesame seeds.",
                'ingredients' => [
                    ['name' => 'Chicken wings', 'quantity' => '1 kg', 'order' => 0],
                    ['name' => 'All-purpose flour', 'quantity' => '1 cup', 'order' => 1],
                    ['name' => 'Gochujang', 'quantity' => '3 tbsp', 'order' => 2],
                    ['name' => 'Honey', 'quantity' => '3 tbsp', 'order' => 3],
                    ['name' => 'Sesame seeds', 'quantity' => '1 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Japchae (Glass Noodles)',
                'instructions' => "Step 1: Soak noodles in warm water.\nStep 2: Julienne vegetables.\nStep 3: Marinate and cook beef.\nStep 4: Stir-fry vegetables separately.\nStep 5: Boil noodles for 6-7 minutes.\nStep 6: Mix noodles with soy sauce and sesame oil.\nStep 7: Combine everything.\nStep 8: Garnish with sesame seeds.",
                'ingredients' => [
                    ['name' => 'Sweet potato noodles', 'quantity' => '200g', 'order' => 0],
                    ['name' => 'Beef sirloin', 'quantity' => '200g', 'order' => 1],
                    ['name' => 'Carrots', 'quantity' => '2', 'order' => 2],
                    ['name' => 'Spinach', 'quantity' => '100g', 'order' => 3],
                    ['name' => 'Sesame oil', 'quantity' => '3 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Tteokbokki (Spicy Rice Cakes)',
                'instructions' => "Step 1: Soak rice cakes if frozen.\nStep 2: Make sauce with gochujang and gochugaru.\nStep 3: Bring water to boil.\nStep 4: Add rice cakes and fish cakes.\nStep 5: Add sauce and stir.\nStep 6: Simmer until thick.\nStep 7: Add green onions and eggs.\nStep 8: Serve hot.",
                'ingredients' => [
                    ['name' => 'Korean rice cakes', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Fish cakes', 'quantity' => '100g', 'order' => 1],
                    ['name' => 'Gochujang', 'quantity' => '3 tbsp', 'order' => 2],
                    ['name' => 'Sugar', 'quantity' => '2 tbsp', 'order' => 3],
                    ['name' => 'Boiled eggs', 'quantity' => '2', 'order' => 4],
                ],
            ],

            // FILIPINO RECIPES (5)
            [
                'title' => 'Chicken Adobo',
                'instructions' => "Step 1: Marinate chicken in soy sauce, vinegar, and garlic.\nStep 2: Brown chicken in oil.\nStep 3: Add marinade and water.\nStep 4: Simmer for 30-40 minutes.\nStep 5: Remove chicken and reduce sauce.\nStep 6: Return chicken and coat.\nStep 7: Serve with rice.",
                'ingredients' => [
                    ['name' => 'Chicken pieces', 'quantity' => '1 kg', 'order' => 0],
                    ['name' => 'Soy sauce', 'quantity' => '1/2 cup', 'order' => 1],
                    ['name' => 'White vinegar', 'quantity' => '1/3 cup', 'order' => 2],
                    ['name' => 'Garlic cloves', 'quantity' => '8', 'order' => 3],
                    ['name' => 'Bay leaves', 'quantity' => '3', 'order' => 4],
                ],
            ],
            [
                'title' => 'Sinigang na Baboy (Sour Soup)',
                'instructions' => "Step 1: Boil pork ribs until tender.\nStep 2: Add onions and tomatoes.\nStep 3: Add radish and cook.\nStep 4: Add tamarind paste.\nStep 5: Add vegetables.\nStep 6: Add water spinach last.\nStep 7: Season with fish sauce.\nStep 8: Serve hot.",
                'ingredients' => [
                    ['name' => 'Pork ribs', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Tamarind paste', 'quantity' => '2 tbsp', 'order' => 1],
                    ['name' => 'Tomatoes', 'quantity' => '2', 'order' => 2],
                    ['name' => 'Radish', 'quantity' => '1', 'order' => 3],
                    ['name' => 'Water spinach', 'quantity' => '1 bunch', 'order' => 4],
                ],
            ],
            [
                'title' => 'Lumpia Shanghai (Spring Rolls)',
                'instructions' => "Step 1: Mix ground pork with vegetables and seasonings.\nStep 2: Place filling on lumpia wrapper.\nStep 3: Roll tightly and seal with water.\nStep 4: Heat oil to 350°F.\nStep 5: Fry until golden brown.\nStep 6: Drain on paper towels.\nStep 7: Serve with sweet chili sauce.",
                'ingredients' => [
                    ['name' => 'Ground pork', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Lumpia wrappers', 'quantity' => '25 pieces', 'order' => 1],
                    ['name' => 'Carrots, minced', 'quantity' => '1 cup', 'order' => 2],
                    ['name' => 'Onion, minced', 'quantity' => '1', 'order' => 3],
                    ['name' => 'Soy sauce', 'quantity' => '2 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Pancit Canton (Stir-Fried Noodles)',
                'instructions' => "Step 1: Soak noodles in water.\nStep 2: Sauté garlic and onions.\nStep 3: Add chicken and cook.\nStep 4: Add vegetables and stir-fry.\nStep 5: Add noodles and soy sauce.\nStep 6: Toss everything together.\nStep 7: Garnish with green onions.\nStep 8: Serve with calamansi.",
                'ingredients' => [
                    ['name' => 'Canton noodles', 'quantity' => '400g', 'order' => 0],
                    ['name' => 'Chicken breast', 'quantity' => '300g', 'order' => 1],
                    ['name' => 'Cabbage', 'quantity' => '2 cups', 'order' => 2],
                    ['name' => 'Carrots', 'quantity' => '2', 'order' => 3],
                    ['name' => 'Soy sauce', 'quantity' => '1/4 cup', 'order' => 4],
                ],
            ],
            [
                'title' => 'Lechon Kawali (Crispy Pork Belly)',
                'instructions' => "Step 1: Boil pork belly with bay leaves and peppercorns.\nStep 2: Let cool and pat dry.\nStep 3: Rub with salt.\nStep 4: Refrigerate overnight.\nStep 5: Heat oil for deep frying.\nStep 6: Fry until golden and crispy.\nStep 7: Drain and let rest.\nStep 8: Chop and serve with liver sauce.",
                'ingredients' => [
                    ['name' => 'Pork belly', 'quantity' => '1 kg', 'order' => 0],
                    ['name' => 'Bay leaves', 'quantity' => '3', 'order' => 1],
                    ['name' => 'Peppercorns', 'quantity' => '1 tbsp', 'order' => 2],
                    ['name' => 'Salt', 'quantity' => '2 tbsp', 'order' => 3],
                    ['name' => 'Vegetable oil', 'quantity' => 'for frying', 'order' => 4],
                ],
            ],

            // ITALIAN RECIPES (5)
            [
                'title' => 'Spaghetti Carbonara',
                'instructions' => "Step 1: Cook spaghetti in salted water.\nStep 2: Fry pancetta until crispy.\nStep 3: Whisk eggs with Parmesan.\nStep 4: Drain pasta, reserve water.\nStep 5: Add pasta to pancetta.\nStep 6: Pour egg mixture, toss quickly.\nStep 7: Add pasta water if needed.\nStep 8: Serve with extra Parmesan.",
                'ingredients' => [
                    ['name' => 'Spaghetti', 'quantity' => '400g', 'order' => 0],
                    ['name' => 'Pancetta', 'quantity' => '150g', 'order' => 1],
                    ['name' => 'Eggs', 'quantity' => '4', 'order' => 2],
                    ['name' => 'Parmesan cheese', 'quantity' => '1 cup', 'order' => 3],
                    ['name' => 'Black pepper', 'quantity' => '1 tsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Margherita Pizza',
                'instructions' => "Step 1: Make pizza dough and let rise.\nStep 2: Roll out dough into circle.\nStep 3: Spread tomato sauce.\nStep 4: Add mozzarella slices.\nStep 5: Drizzle with olive oil.\nStep 6: Bake at 475°F for 12-15 minutes.\nStep 7: Add fresh basil.\nStep 8: Serve immediately.",
                'ingredients' => [
                    ['name' => 'Pizza dough', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Tomato sauce', 'quantity' => '1 cup', 'order' => 1],
                    ['name' => 'Fresh mozzarella', 'quantity' => '250g', 'order' => 2],
                    ['name' => 'Fresh basil', 'quantity' => '1 bunch', 'order' => 3],
                    ['name' => 'Olive oil', 'quantity' => '2 tbsp', 'order' => 4],
                ],
            ],
            [
                'title' => 'Lasagna Bolognese',
                'instructions' => "Step 1: Make Bolognese sauce with ground beef and tomatoes.\nStep 2: Make béchamel sauce.\nStep 3: Cook lasagna sheets.\nStep 4: Layer sauce, pasta, and béchamel.\nStep 5: Repeat layers.\nStep 6: Top with mozzarella and Parmesan.\nStep 7: Bake at 375°F for 45 minutes.\nStep 8: Let rest before serving.",
                'ingredients' => [
                    ['name' => 'Lasagna sheets', 'quantity' => '12', 'order' => 0],
                    ['name' => 'Ground beef', 'quantity' => '500g', 'order' => 1],
                    ['name' => 'Tomato sauce', 'quantity' => '3 cups', 'order' => 2],
                    ['name' => 'Mozzarella', 'quantity' => '300g', 'order' => 3],
                    ['name' => 'Parmesan', 'quantity' => '1 cup', 'order' => 4],
                ],
            ],
            [
                'title' => 'Risotto alla Milanese',
                'instructions' => "Step 1: Sauté onions in butter.\nStep 2: Add Arborio rice and toast.\nStep 3: Add white wine and stir.\nStep 4: Add hot stock gradually, stirring constantly.\nStep 5: Add saffron threads.\nStep 6: Continue adding stock until rice is creamy.\nStep 7: Stir in butter and Parmesan.\nStep 8: Serve immediately.",
                'ingredients' => [
                    ['name' => 'Arborio rice', 'quantity' => '2 cups', 'order' => 0],
                    ['name' => 'Chicken stock', 'quantity' => '6 cups', 'order' => 1],
                    ['name' => 'White wine', 'quantity' => '1/2 cup', 'order' => 2],
                    ['name' => 'Saffron threads', 'quantity' => '1 pinch', 'order' => 3],
                    ['name' => 'Parmesan cheese', 'quantity' => '1 cup', 'order' => 4],
                ],
            ],
            [
                'title' => 'Tiramisu',
                'instructions' => "Step 1: Make espresso and let cool.\nStep 2: Whisk egg yolks with sugar.\nStep 3: Fold in mascarpone cheese.\nStep 4: Whip cream and fold in.\nStep 5: Dip ladyfingers in espresso.\nStep 6: Layer ladyfingers and cream.\nStep 7: Repeat layers.\nStep 8: Dust with cocoa powder and refrigerate 4 hours.",
                'ingredients' => [
                    ['name' => 'Ladyfinger cookies', 'quantity' => '24', 'order' => 0],
                    ['name' => 'Mascarpone cheese', 'quantity' => '500g', 'order' => 1],
                    ['name' => 'Espresso', 'quantity' => '2 cups', 'order' => 2],
                    ['name' => 'Egg yolks', 'quantity' => '6', 'order' => 3],
                    ['name' => 'Cocoa powder', 'quantity' => '2 tbsp', 'order' => 4],
                ],
            ],

            // MEXICAN RECIPES (5)
            [
                'title' => 'Tacos al Pastor',
                'instructions' => "Step 1: Marinate pork with achiote, pineapple juice, and spices.\nStep 2: Grill or pan-fry pork until charred.\nStep 3: Chop pork into small pieces.\nStep 4: Warm corn tortillas.\nStep 5: Fill with pork.\nStep 6: Top with pineapple, onions, and cilantro.\nStep 7: Serve with lime wedges.\nStep 8: Add salsa to taste.",
                'ingredients' => [
                    ['name' => 'Pork shoulder', 'quantity' => '1 kg', 'order' => 0],
                    ['name' => 'Achiote paste', 'quantity' => '3 tbsp', 'order' => 1],
                    ['name' => 'Pineapple', 'quantity' => '1 cup', 'order' => 2],
                    ['name' => 'Corn tortillas', 'quantity' => '12', 'order' => 3],
                    ['name' => 'Cilantro', 'quantity' => '1 bunch', 'order' => 4],
                ],
            ],
            [
                'title' => 'Chicken Enchiladas',
                'instructions' => "Step 1: Cook and shred chicken.\nStep 2: Make enchilada sauce with chili peppers.\nStep 3: Warm tortillas.\nStep 4: Fill with chicken and cheese.\nStep 5: Roll and place in baking dish.\nStep 6: Pour sauce over enchiladas.\nStep 7: Top with more cheese.\nStep 8: Bake at 350°F for 25 minutes.",
                'ingredients' => [
                    ['name' => 'Chicken breast', 'quantity' => '500g', 'order' => 0],
                    ['name' => 'Flour tortillas', 'quantity' => '8', 'order' => 1],
                    ['name' => 'Enchilada sauce', 'quantity' => '2 cups', 'order' => 2],
                    ['name' => 'Cheddar cheese', 'quantity' => '2 cups', 'order' => 3],
                    ['name' => 'Sour cream', 'quantity' => '1/2 cup', 'order' => 4],
                ],
            ],
            [
                'title' => 'Guacamole',
                'instructions' => "Step 1: Mash avocados in a bowl.\nStep 2: Add lime juice immediately.\nStep 3: Mix in diced tomatoes.\nStep 4: Add minced onions and jalapeños.\nStep 5: Stir in cilantro.\nStep 6: Season with salt and pepper.\nStep 7: Taste and adjust seasonings.\nStep 8: Serve with tortilla chips.",
                'ingredients' => [
                    ['name' => 'Ripe avocados', 'quantity' => '4', 'order' => 0],
                    ['name' => 'Lime juice', 'quantity' => '2 tbsp', 'order' => 1],
                    ['name' => 'Tomatoes', 'quantity' => '2', 'order' => 2],
                    ['name' => 'Onion', 'quantity' => '1/2', 'order' => 3],
                    ['name' => 'Cilantro', 'quantity' => '1/4 cup', 'order' => 4],
                ],
            ],
            [
                'title' => 'Chiles Rellenos',
                'instructions' => "Step 1: Roast poblano peppers until charred.\nStep 2: Peel and make a slit to remove seeds.\nStep 3: Stuff with cheese.\nStep 4: Make egg batter.\nStep 5: Dip peppers in batter.\nStep 6: Fry until golden.\nStep 7: Serve with tomato sauce.\nStep 8: Garnish with crema.",
                'ingredients' => [
                    ['name' => 'Poblano peppers', 'quantity' => '6', 'order' => 0],
                    ['name' => 'Oaxaca cheese', 'quantity' => '300g', 'order' => 1],
                    ['name' => 'Eggs', 'quantity' => '4', 'order' => 2],
                    ['name' => 'Flour', 'quantity' => '1/2 cup', 'order' => 3],
                    ['name' => 'Tomato sauce', 'quantity' => '2 cups', 'order' => 4],
                ],
            ],
            [
                'title' => 'Pozole Rojo',
                'instructions' => "Step 1: Boil pork shoulder until tender.\nStep 2: Add hominy and continue cooking.\nStep 3: Make red chili sauce.\nStep 4: Add sauce to pot.\nStep 5: Simmer for 30 minutes.\nStep 6: Season with oregano and salt.\nStep 7: Serve in bowls.\nStep 8: Top with cabbage, radishes, and lime.",
                'ingredients' => [
                    ['name' => 'Pork shoulder', 'quantity' => '1 kg', 'order' => 0],
                    ['name' => 'Hominy', 'quantity' => '2 cans', 'order' => 1],
                    ['name' => 'Dried chili peppers', 'quantity' => '6', 'order' => 2],
                    ['name' => 'Cabbage', 'quantity' => '1/2 head', 'order' => 3],
                    ['name' => 'Radishes', 'quantity' => '6', 'order' => 4],
                ],
            ],
        ];
    }
}
