<div class="min-h-screen bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('recipes.show', $recipe) }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200 group mb-4 sm:mb-6">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-medium">Back to Recipe</span>
            </a>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                        Edit Recipe
                    </h1>
                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                        Update your recipe details and ingredients
                    </p>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Auto-saving</span>
                </div>
            </div>
        </div>

        <form wire:submit="save" id="edit-recipe-form" class="space-y-6 sm:space-y-8">
            <!-- Recipe Title Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transform transition-all duration-200 hover:shadow-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <label class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                            Recipe Title
                        </label>
                    </div>
                    <input 
                        wire:model.blur="title" 
                        type="text"
                        placeholder="e.g., Grandma's Chocolate Chip Cookies"
                        required
                        class="w-full px-4 py-3 sm:py-4 bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200 text-base sm:text-lg"
                    />
                    @error('title') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Ingredients Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transform transition-all duration-200 hover:shadow-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                                    Ingredients
                                </h2>
                                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                    {{ count($ingredients) }} ingredient{{ count($ingredients) !== 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>
                        <button 
                            type="button" 
                            wire:click="addIngredient" 
                            class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Ingredient</span>
                        </button>
                    </div>

                    <div class="space-y-3 sm:space-y-4">
                        @foreach ($ingredients as $index => $ingredient)
                            <div class="group relative bg-gray-50 dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-200 dark:border-gray-700 hover:border-orange-300 dark:hover:border-orange-600 transition-all duration-200" wire:key="ingredient-{{ $index }}">
                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                    <!-- Ingredient Number Badge -->
                                    <div class="hidden sm:flex items-center justify-center w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 text-white rounded-lg font-bold text-sm shadow-md flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    
                                    <!-- Mobile Number Badge -->
                                    <div class="sm:hidden absolute -top-2 -left-2 w-6 h-6 bg-gradient-to-br from-orange-500 to-amber-600 text-white rounded-full font-bold text-xs flex items-center justify-center shadow-md">
                                        {{ $index + 1 }}
                                    </div>

                                    <!-- Ingredient Name -->
                                    <div class="flex-1">
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Ingredient Name
                                        </label>
                                        <input 
                                            wire:model.blur="ingredients.{{ $index }}.name" 
                                            type="text"
                                            placeholder="e.g., All-purpose flour"
                                            required
                                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200 text-sm sm:text-base"
                                        />
                                        @error("ingredients.{$index}.name") 
                                            <p class="mt-1 text-xs text-red-600 dark:text-red-400 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p> 
                                        @enderror
                                    </div>

                                    <!-- Quantity -->
                                    <div class="w-full sm:w-40">
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Quantity
                                        </label>
                                        <input 
                                            wire:model.blur="ingredients.{{ $index }}.quantity" 
                                            type="text"
                                            placeholder="e.g., 2 cups"
                                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200 text-sm sm:text-base"
                                        />
                                    </div>

                                    <!-- Remove Button -->
                                    @if (count($ingredients) > 1)
                                        <div class="flex items-end">
                                            <button 
                                                type="button" 
                                                wire:click="removeIngredient({{ $index }})" 
                                                class="w-full sm:w-auto px-4 py-2.5 sm:py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 font-semibold transition-all duration-200 flex items-center justify-center gap-2 group"
                                                title="Remove ingredient"
                                            >
                                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span class="hidden sm:inline">Remove</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if(count($ingredients) === 0)
                        <div class="text-center py-12 px-4">
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm sm:text-base">No ingredients yet. Click "Add Ingredient" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cooking Instructions Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transform transition-all duration-200 hover:shadow-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <label class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                                Cooking Instructions
                            </label>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                Provide step-by-step directions
                            </p>
                        </div>
                    </div>
                    <textarea 
                        wire:model.blur="instructions" 
                        placeholder="Step 1: Preheat oven to 350°F (175°C)&#10;Step 2: Mix dry ingredients in a large bowl&#10;Step 3: Combine wet ingredients separately&#10;Step 4: Fold wet into dry ingredients until just combined&#10;Step 5: Bake for 20-25 minutes until golden brown"
                        rows="12"
                        required
                        class="w-full px-4 py-3 sm:py-4 bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-gray-900 dark:text-white placeholder-gray-400 transition-all duration-200 resize-none text-sm sm:text-base leading-relaxed"
                    ></textarea>
                    @error('instructions') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

        </form>

        <!-- Action Buttons -->
        <div class="mt-6 sm:mt-8 pb-6">
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <button 
                    type="submit" 
                    form="edit-recipe-form"
                    wire:loading.attr="disabled"
                    class="flex-1 sm:flex-none px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2 text-base sm:text-lg"
                >
                    <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Recipe
                    </span>
                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Updating...
                    </span>
                </button>
                <a 
                    href="{{ route('recipes.show', $recipe) }}" 
                    class="flex-1 sm:flex-none px-6 sm:px-8 py-3 sm:py-4 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold transition-all duration-200 text-center flex items-center justify-center gap-2 text-base sm:text-lg"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
