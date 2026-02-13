<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Show extends Component
{
    public Recipe $recipe;

    public function mount(Recipe $recipe): void
    {
        $this->recipe = $recipe->load(['user', 'ingredients']);
        
        // Increment view count only if the viewer is not the owner
        if (!auth()->check() || auth()->id() !== $recipe->user_id) {
            $recipe->increment('views');
        }
    }

    public function delete(): void
    {
        if (auth()->id() !== $this->recipe->user_id) {
            return;
        }

        $this->recipe->delete();
        $this->redirect(route('my-recipes'), navigate: true);
    }

    public function render()
    {
        return view('livewire.recipes.show');
    }
}
