<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Get all recipes
        $recipes = Recipe::with(['user', 'ingredients'])->latest()->get();
        
        return view('livewire.recipes.index', [
            'recipes' => $recipes
        ]);
    }
}
