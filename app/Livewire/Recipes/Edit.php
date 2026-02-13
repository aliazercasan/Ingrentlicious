<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Livewire\Component;

class Edit extends Component
{
    public Recipe $recipe;
    public $title;
    public $instructions;
    public $ingredients = [];

    public function mount(Recipe $recipe): void
    {
        $this->authorize('update', $recipe);
        
        $this->recipe = $recipe->load('ingredients');
        $this->title = $recipe->title;
        $this->instructions = $recipe->instructions;
        $this->ingredients = $recipe->ingredients->map(fn($i) => [
            'id' => $i->id,
            'name' => $i->name,
            'quantity' => $i->quantity
        ])->toArray();
    }

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
        $this->authorize('update', $this->recipe);

        $this->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:100',
        ]);

        $this->recipe->update([
            'title' => $this->title,
            'instructions' => $this->instructions,
        ]);

        $this->recipe->ingredients()->delete();

        foreach ($this->ingredients as $ingredient) {
            if (!empty($ingredient['name'])) {
                $this->recipe->ingredients()->create([
                    'name' => $ingredient['name'],
                    'quantity' => $ingredient['quantity'] ?? null,
                ]);
            }
        }

        $this->redirect(route('recipes.show', $this->recipe), navigate: true);
    }

    public function render()
    {
        return view('livewire.recipes.edit');
    }
}
