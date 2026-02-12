<?php

use App\Models\Recipe;
use Livewire\Component;

new class extends Component {
    public Recipe $recipe;

    public function mount(Recipe $recipe): void
    {
        $this->recipe = $recipe->load(['user', 'ingredients']);
    }

    public function delete(): void
    {
        if (auth()->id() !== $this->recipe->user_id) {
            return;
        }

        $this->recipe->delete();
        $this->redirect(route('recipes.index'), navigate: true);
    }
}; ?>

<div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div wire:loading class="animate-pulse">
            <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-4"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/4 mb-8"></div>
            <div class="space-y-4">
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
        </div>

        <div wire:loading.remove>
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $recipe->title }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        By {{ $recipe->user->name }} • {{ $recipe->created_at->diffForHumans() }}
                    </p>
                </div>

                @can('update', $recipe)
                    <div class="flex gap-2">
                        <flux:button href="{{ route('recipes.edit', $recipe) }}" variant="ghost" size="sm">
                            Edit
                        </flux:button>
                        <flux:button wire:click="delete" wire:confirm="Are you sure you want to delete this recipe?" variant="danger" size="sm">
                            Delete
                        </flux:button>
                    </div>
                @endcan
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                    Ingredients
                </h2>
                <ul class="space-y-2">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li class="flex items-start text-gray-700 dark:text-gray-300">
                            <span class="text-blue-500 mr-2">•</span>
                            <span>
                                @if($ingredient->quantity)
                                    <strong>{{ $ingredient->quantity }}</strong>
                                @endif
                                {{ $ingredient->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                    Instructions
                </h2>
                <div class="prose dark:prose-invert max-w-none">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>

            <div class="mt-8">
                <flux:button href="{{ route('recipes.index') }}" variant="ghost">
                    ← Back to Recipes
                </flux:button>
            </div>
        </div>
    </div>
</div>
