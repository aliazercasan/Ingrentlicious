<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.recipes.index', [
            'recipes' => Recipe::with('user', 'ingredients')->latest()->get()
        ]);
    }
}
