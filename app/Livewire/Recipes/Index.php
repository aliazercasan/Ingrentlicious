<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        // Get recipes with pagination - 24 per page
        $recipes = Recipe::with(['user', 'ingredients'])
            ->latest()
            ->paginate(24);
        
        return view('livewire.recipes.index', [
            'recipes' => $recipes
        ]);
    }
}
