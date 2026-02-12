<?php

use App\Models\Recipe;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function recipes()
    {
        return Recipe::with(['user', 'ingredients'])
            ->latest()
            ->get();
    }
};
?>

<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-guest-notice />
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Ingrentlicious Recipes</h1>
            
            @auth
                <flux:button href="{{ route('recipes.create') }}" icon="plus">
                    Add Recipe
                </flux:button>
            @else
                <flux:button wire:click="$dispatch('show-auth-modal')" variant="ghost">
                    Login to Add Recipe
                </flux:button>
            @endauth
        </div>

        <div wire:loading class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 0; $i < 6; $i++)
                <div class="animate-pulse bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-4"></div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/2 mb-2"></div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-5/6"></div>
                </div>
            @endfor
        </div>

        <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($this->recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe) }}" 
                   class="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $recipe->title }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        By {{ $recipe->user->name }}
                    </p>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <flux:icon.book-open-text class="w-4 h-4 mr-2" />
                        {{ $recipe->ingredients->count() }} ingredients
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                        No recipes yet. Be the first to add one!
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>