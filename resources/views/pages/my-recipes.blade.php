<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Recipes - Ingrentlicious</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-gray-900/80 border-b border-orange-200/50 dark:border-gray-700/50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 sm:h-20">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3 group">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                            <span class="text-2xl sm:text-3xl">🍳</span>
                        </div>
                        <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                            Ingrentlicious
                        </span>
                    </a>
                    <nav class="flex items-center gap-2 sm:gap-4">
                       
                        <a href="{{ route('recipes.create') }}" class="px-3 py-2 sm:px-6 sm:py-2.5 bg-gradient-to-r from-orange-500 to-amber-600 text-white text-sm sm:text-base rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            + Add Recipe
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="font-medium">Back to Dashboard</span>
                    </a>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 sm:mb-10">
                    <div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                            My Recipes
                        </h1>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                            All the delicious recipes you've shared
                        </p>
                    </div>
                </div>

                @php
                    $myRecipes = auth()->user()->recipes()->with('ingredients')->latest()->get();
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    @forelse ($myRecipes as $recipe)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden">
                            <div class="h-48 sm:h-56 bg-gradient-to-br from-orange-400 via-amber-400 to-yellow-400 relative overflow-hidden">
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all duration-300"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-6xl sm:text-7xl opacity-50 group-hover:opacity-70 transition-opacity duration-300">🍽️</span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-orange-600 text-xs font-semibold rounded-full shadow-md">
                                        {{ $recipe->ingredients->count() }} ingredients
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-200 line-clamp-2">
                                    {{ $recipe->title }}
                                </h3>
                                
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <div class="flex gap-2 pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <a href="{{ route('recipes.show', $recipe) }}" class="flex-1 text-center px-4 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-lg hover:bg-orange-200 dark:hover:bg-orange-900/50 font-semibold transition-all duration-200">
                                        View
                                    </a>
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="flex-1 text-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold transition-all duration-200">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-16 sm:py-20 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-2xl border-2 border-dashed border-orange-200 dark:border-orange-800">
                                <div class="text-6xl sm:text-7xl mb-4">👨‍🍳</div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                    No recipes yet
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">
                                    Start sharing your delicious recipes with the community!
                                </p>
                                <a href="{{ route('recipes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Add Your First Recipe
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
    
    @livewireScripts
</body>
</html>
