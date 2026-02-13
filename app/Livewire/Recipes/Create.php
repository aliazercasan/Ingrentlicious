<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Create extends Component
{
    public $title = '';
    public $instructions = '';
    public $ingredients = [['name' => '', 'quantity' => '']];

    public function addIngredient(): void
    {
        $this->ingredients[] = ['name' => '', 'quantity' => ''];
    }

    public function removeIngredient($index): void
    {
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:100',
        ]);

        $recipe = Recipe::create([
            'title' => $this->title,
            'instructions' => $this->instructions,
            'user_id' => auth()->id(),
        ]);

        foreach ($this->ingredients as $ingredient) {
            if (!empty($ingredient['name'])) {
                $recipe->ingredients()->create($ingredient);
            }
        }

        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.recipes.create');
    }
}
