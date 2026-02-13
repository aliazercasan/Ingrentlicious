<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Get all recipes except the authenticated user's recipes
        $query = Recipe::with(['user', 'ingredients'])->latest();
        
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }
        
        return view('livewire.recipes.index', [
            'recipes' => $query->get()
        ]);
    }
}
