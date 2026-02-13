<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipe Views - Ingrentlicious</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                       
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors duration-200">
                            Dashboard
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

                <div class="mb-8">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                        Recipe Views
                    </h1>
                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                        Track how many times your recipes have been viewed
                    </p>
                </div>

                @php
                    $recipes = auth()->user()->recipes()->orderBy('views', 'desc')->get();
                    $totalViews = $recipes->sum('views');
                @endphp

                <!-- Stats Card -->
                <div class="bg-gradient-to-r from-orange-500 to-amber-600 rounded-2xl shadow-xl p-6 sm:p-8 mb-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm sm:text-base opacity-90 mb-1">Total Views</p>
                            <p class="text-4xl sm:text-5xl font-bold">{{ number_format($totalViews) }}</p>
                        </div>
                        <div class="text-5xl sm:text-6xl opacity-80">
                            👁️
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-orange-500 to-amber-600 text-white">
                                <tr>
                                    <th class="px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider">
                                        Recipe Name
                                    </th>
                                    <th class="px-4 sm:px-6 py-4 text-center text-xs sm:text-sm font-semibold uppercase tracking-wider">
                                        Views
                                    </th>
                                    <th class="px-4 sm:px-6 py-4 text-center text-xs sm:text-sm font-semibold uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($recipes as $recipe)
                                    <tr class="hover:bg-orange-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <span class="text-xl">🍽️</span>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white truncate">
                                                        {{ $recipe->title }}
                                                    </p>
                                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $recipe->ingredients->count() }} ingredients
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-center">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-full text-sm font-semibold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                {{ number_format($recipe->views) }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-center">
                                            <a href="{{ route('recipes.show', $recipe) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-xs sm:text-sm font-medium transition-colors duration-200">
                                                View Recipe
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="text-6xl mb-4">📊</div>
                                            <p class="text-gray-500 dark:text-gray-400 text-lg">
                                                No recipes yet. Create your first recipe to start tracking views!
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
