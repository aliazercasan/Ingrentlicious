<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class FeaturedRecipes extends Component
{
    use WithPagination;

    public function render()
    {
        $recipes = Recipe::with(['user', 'ingredients'])
            ->latest()
            ->paginate(24);
        
        return view('livewire.featured-recipes', [
            'recipes' => $recipes
        ]);
    }
}
