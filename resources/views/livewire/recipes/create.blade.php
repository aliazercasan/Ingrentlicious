<div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-medium">Back to Dashboard</span>
            </a>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                Add New Recipe
            </h1>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Share your delicious recipe with the community
            </p>
        </div>

        <form wire:submit="save" class="space-y-6 sm:space-y-8">
            <!-- Recipe Title -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                    Recipe Title
                </label>
                <input 
                    wire:model="title" 
                    type="text"
                    placeholder="e.g., Chocolate Chip Cookies"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200"
                />
                @error('title') 
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ingredients -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Ingredients
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Add all the ingredients needed for this recipe
                        </p>
                    </div>
                    <button type="button" wire:click="addIngredient" class="px-4 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-xl hover:bg-orange-200 dark:hover:bg-orange-900/50 font-semibold transition-all duration-200 text-sm">
                        + Add
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach ($ingredients as $index => $ingredient)
                        <div class="flex gap-3 items-start" wire:key="ingredient-{{ $index }}">
                            <div class="flex-1">
                                <input 
                                    wire:model="ingredients.{{ $index }}.name" 
                                    type="text"
                                    placeholder="Ingredient name"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200"
                                />
                                @error("ingredients.{$index}.name") 
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> 
                                @enderror
                            </div>
                            <div class="w-32 sm:w-40">
                                <input 
                                    wire:model="ingredients.{{ $index }}.quantity" 
                                    type="text"
                                    placeholder="Quantity"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200"
                                />
                            </div>
                            @if (count($ingredients) > 1)
                                <button 
                                    type="button" 
                                    wire:click="removeIngredient({{ $index }})" 
                                    class="px-4 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl hover:bg-red-200 dark:hover:bg-red-900/50 font-semibold transition-all duration-200"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                @error('ingredients') 
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cooking Instructions -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                    Cooking Instructions
                </label>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Provide step-by-step instructions for preparing this recipe
                </p>
                <textarea 
                    wire:model="instructions" 
                    placeholder="Step 1: Preheat oven to 350°F&#10;Step 2: Mix ingredients...&#10;Step 3: Bake for 20 minutes..."
                    rows="10"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200 resize-none"
                ></textarea>
                @error('instructions') 
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" wire:loading.attr="disabled" class="flex-1 sm:flex-none px-8 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Save Recipe</span>
                    <span wire:loading class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </span>
                </button>
                <a href="{{ route('dashboard') }}" class="flex-1 sm:flex-none px-8 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold transition-all duration-200 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
