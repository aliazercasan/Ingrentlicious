<div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
            Add New Recipe
        </h1>

        <form wire:submit="save" class="space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <flux:input 
                    wire:model="title" 
                    label="Recipe Title" 
                    placeholder="e.g., Chocolate Chip Cookies"
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
                @error('ingredients') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <flux:textarea 
                    wire:model="instructions" 
                    label="Cooking Instructions" 
                    placeholder="Step 1: Preheat oven to 350°F&#10;Step 2: Mix ingredients..."
                    rows="10"
                    required
                />
                @error('instructions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Recipe</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
                <flux:button href="{{ route('recipes.index') }}" variant="ghost">
                    Cancel
                </flux:button>
            </div>
        </form>
    </div>
</div>
