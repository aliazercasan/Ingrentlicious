<?php

use App\Models\Recipe;
use Livewire\Component;

new class extends Component {
    public Recipe $recipe;
    public string $title = '';
    public string $instructions = '';
    public array $ingredients = [];

    public function mount(Recipe $recipe): void
    {
        $this->authorize('update', $recipe);
        
        $this->recipe = $recipe->load('ingredients');
        $this->title = $recipe->title;
        $this->instructions = $recipe->instructions;
        $this->ingredients = $recipe->ingredients->map(fn($ing) => [
            'name' => $ing->name,
            'quantity' => $ing->quantity ?? '',
        ])->toArray();
    }

    public function addIngredient(): void
    {
        $this->ingredients[] = ['name' => '', 'quantity' => ''];
    }

    public function removeIngredient(int $index): void
    {
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }

    public function save(): void
    {
        $this->authorize('update', $this->recipe);

        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:100',
        ]);

        $this->recipe->update([
            'title' => $validated['title'],
            'instructions' => $validated['instructions'],
        ]);

        $this->recipe->ingredients()->delete();

        foreach ($validated['ingredients'] as $index => $ingredient) {
            $this->recipe->ingredients()->create([
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
                'order' => $index,
            ]);
        }

        $this->redirect(route('recipes.show', $this->recipe), navigate: true);
    }
}; ?>

<div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
            Edit Recipe
        </h1>

        <form wire:submit="save" class="space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <flux:input 
                    wire:model="title" 
                    label="Recipe Title" 
                    required
                />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ingredients
                    </h2>
                    <flux:button type="button" wire:click="addIngredient" size="sm" variant="ghost">
                        + Add Ingredient
                    </flux:button>
                </div>

                <div class="space-y-4">
                    @foreach ($ingredients as $index => $ingredient)
                        <div class="flex gap-4 items-start" wire:key="ingredient-{{ $index }}">
                            <div class="flex-1">
                                <flux:input 
                                    wire:model="ingredients.{{ $index }}.name" 
                                    placeholder="Ingredient name"
                                    required
                                />
                                @error("ingredients.{$index}.name") 
                                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <flux:input 
                                    wire:model="ingredients.{{ $index }}.quantity" 
                                    placeholder="Quantity"
                                />
                            </div>
                            @if (count($ingredients) > 1)
                                <flux:button 
                                    type="button" 
                                    wire:click="removeIngredient({{ $index }})" 
                                    variant="danger" 
                                    size="sm"
                                >
                                    Remove
                                </flux:button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <flux:textarea 
                    wire:model="instructions" 
                    label="Cooking Instructions" 
                    rows="10"
                    required
                />
                @error('instructions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Update Recipe</span>
                    <span wire:loading>Updating...</span>
                </flux:button>
                <flux:button href="{{ route('recipes.show', $recipe) }}" variant="ghost">
                    Cancel
                </flux:button>
            </div>
        </form>
    </div>
</div>
