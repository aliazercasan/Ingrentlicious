<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                Welcome to Ingrentlicious! 🍳
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Your friendly recipe assistant is ready to help you explore and share delicious recipes.
            </p>
            <div class="flex gap-4">
               
                <a href="{{ route('recipes.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Add New Recipe
                </a>
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a href="{{ route('my-recipes') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="text-3xl mb-2">📖</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Your Recipes
                </h3>
                <p class="text-2xl font-bold text-orange-600">
                    {{ auth()->user()->recipes()->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    recipes shared
                </p>
                <div class="mt-3 text-orange-600 text-sm font-medium flex items-center gap-1">
                    View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('recipe-views') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="text-3xl mb-2">👁️</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Visitor Views
                </h3>
                <p class="text-2xl font-bold text-orange-600">
                    {{ auth()->user()->recipes()->sum('views') }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    total views
                </p>
                <div class="mt-3 text-orange-600 text-sm font-medium flex items-center gap-1">
                    View details
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
           
           
        </div>
    </div>
</x-layouts::app>
