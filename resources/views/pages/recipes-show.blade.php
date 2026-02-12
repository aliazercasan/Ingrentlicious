<x-layouts::app :title="$recipe->title">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <flux:button href="{{ route('recipes.index') }}" variant="ghost" icon="arrow-left">
                Back to Recipes
            </flux:button>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $recipe->title }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        By {{ $recipe->user->name }}
                    </p>
                </div>

                @can('update', $recipe)
                    <flux:button href="{{ route('recipes.edit', $recipe) }}" icon="pencil">
                        Edit
                    </flux:button>
                @endcan
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Ingredients</h2>
                <ul class="space-y-2">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li class="flex items-start">
                            <span class="text-gray-600 dark:text-gray-400 mr-2">•</span>
                            <span class="text-gray-900 dark:text-white">
                                {{ $ingredient->quantity }} {{ $ingredient->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Instructions</h2>
                <div class="prose dark:prose-invert max-w-none">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
