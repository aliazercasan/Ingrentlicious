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
                <a href="{{ route('recipes.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Browse All Recipes
                </a>
                <a href="{{ route('recipes.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Add New Recipe
                </a>
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-3xl mb-2">📖</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Your Recipes
                </h3>
                <p class="text-2xl font-bold text-blue-600">
                    {{ auth()->user()->recipes()->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    recipes shared
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-3xl mb-2">🌟</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Total Recipes
                </h3>
                <p class="text-2xl font-bold text-green-600">
                    {{ \App\Models\Recipe::count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    in the community
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-3xl mb-2">👨‍🍳</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Contributors
                </h3>
                <p class="text-2xl font-bold text-purple-600">
                    {{ \App\Models\User::has('recipes')->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    active chefs
                </p>
            </div>
        </div>
    </div>
</x-layouts::app>
