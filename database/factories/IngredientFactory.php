<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'recipe_id' => Recipe::factory(),
            'name' => fake()->randomElement([
                'All-purpose flour',
                'Sugar',
                'Salt',
                'Butter',
                'Eggs',
                'Milk',
                'Olive oil',
                'Garlic',
                'Onion',
                'Tomatoes',
            ]),
            'quantity' => fake()->randomElement([
                '1 cup',
                '2 cups',
                '1 tbsp',
                '2 tsp',
                '1/2 cup',
                '3/4 cup',
                '1 lb',
                '2 cloves',
                'to taste',
            ]),
            'order' => 0,
        ];
    }
}
