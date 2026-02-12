<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    public function definition(): array
    {
        $recipes = [
            [
                'title' => 'Homemade Pizza Margherita',
                'instructions' => "Step 1: Preheat oven to 475°F with pizza stone inside.\n\nStep 2: Roll out pizza dough on floured surface.\n\nStep 3: Spread tomato sauce evenly over dough.\n\nStep 4: Add fresh mozzarella slices.\n\nStep 5: Bake for 12-15 minutes until crust is golden.\n\nStep 6: Top with fresh basil leaves and drizzle with olive oil.",
            ],
            [
                'title' => 'Chicken Stir Fry',
                'instructions' => "Step 1: Cut chicken into bite-sized pieces.\n\nStep 2: Heat oil in wok over high heat.\n\nStep 3: Stir-fry chicken until cooked through, remove and set aside.\n\nStep 4: Stir-fry vegetables until tender-crisp.\n\nStep 5: Return chicken to wok.\n\nStep 6: Add sauce and toss to combine.\n\nStep 7: Serve over rice.",
            ],
            [
                'title' => 'Caesar Salad',
                'instructions' => "Step 1: Wash and dry romaine lettuce, tear into pieces.\n\nStep 2: Make dressing by whisking together mayo, lemon juice, garlic, and Parmesan.\n\nStep 3: Toss lettuce with dressing.\n\nStep 4: Add croutons and extra Parmesan.\n\nStep 5: Top with grilled chicken if desired.\n\nStep 6: Serve immediately.",
            ],
            [
                'title' => 'Banana Bread',
                'instructions' => "Step 1: Preheat oven to 350°F and grease a loaf pan.\n\nStep 2: Mash ripe bananas in a bowl.\n\nStep 3: Mix in melted butter, sugar, egg, and vanilla.\n\nStep 4: Sprinkle baking soda and salt over mixture.\n\nStep 5: Stir in flour until just combined.\n\nStep 6: Pour into prepared pan.\n\nStep 7: Bake for 60 minutes until toothpick comes out clean.",
            ],
            [
                'title' => 'Beef Tacos',
                'instructions' => "Step 1: Brown ground beef in a skillet.\n\nStep 2: Add taco seasoning and water, simmer.\n\nStep 3: Warm taco shells in oven.\n\nStep 4: Prepare toppings: shred lettuce, dice tomatoes, grate cheese.\n\nStep 5: Fill shells with beef.\n\nStep 6: Top with lettuce, tomatoes, cheese, and sour cream.\n\nStep 7: Serve with salsa.",
            ],
        ];

        $recipe = fake()->randomElement($recipes);

        return [
            'user_id' => User::factory(),
            'title' => $recipe['title'],
            'instructions' => $recipe['instructions'],
        ];
    }
}
