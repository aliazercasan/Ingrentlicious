<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingrentlicious</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Modern Header with Glass Effect -->
        <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-gray-900/80 border-b border-orange-200/50 dark:border-gray-700/50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 sm:h-20">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3 group">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                            <span class="text-2xl sm:text-3xl">🍳</span>
                        </div>
                        <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                            Ingrentlicious
                        </span>
                    </a>
                    
                    <!-- Navigation -->
                    <nav class="flex items-center gap-2 sm:gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors duration-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-3 py-2 sm:px-6 sm:py-2.5 bg-gradient-to-r from-orange-500 to-amber-600 text-white text-sm sm:text-base rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                Get Started
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-100/50 via-amber-100/30 to-yellow-100/50 dark:from-orange-900/20 dark:via-amber-900/10 dark:to-yellow-900/20"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 lg:py-24">
                    <div class="text-center mb-12 sm:mb-16">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 sm:mb-6">
                            <span class="bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600 bg-clip-text text-transparent">
                                Your Friendly
                            </span>
                            <br class="hidden sm:block">
                            <span class="bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 bg-clip-text text-transparent">
                                Recipe Assistant
                            </span>
                        </h1>
                        <p class="text-lg sm:text-xl lg:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto px-4">
                            Explore delicious recipes, share your own creations, and cook with confidence
                        </p>
                    </div>
                    
                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 sm:mb-10">
                        <div>
                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                                Featured Recipes
                            </h2>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                                Discover amazing dishes from our community
                            </p>
                        </div>
                        
                        @auth
                            <a href="{{ route('recipes.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Recipe
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto text-center px-6 py-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-orange-600 dark:text-orange-400 rounded-xl hover:bg-white dark:hover:bg-gray-800 font-semibold shadow-md hover:shadow-lg transition-all duration-300 border border-orange-200 dark:border-orange-800">
                                Login to Add Recipe
                            </a>
                        @endauth
                    </div>

                    @php
                        $recipes = \App\Models\Recipe::with(['user', 'ingredients'])->latest()->get();
                    @endphp

                    <!-- Recipe Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        @forelse ($recipes as $recipe)
                            <a href="{{ route('recipes.show', $recipe) }}" 
                               class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                                <!-- Recipe Image Placeholder -->
                                <div class="h-48 sm:h-56 bg-gradient-to-br from-orange-400 via-amber-400 to-yellow-400 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all duration-300"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-6xl sm:text-7xl opacity-50 group-hover:opacity-70 transition-opacity duration-300">🍽️</span>
                                    </div>
                                    <!-- Category Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-orange-600 text-xs font-semibold rounded-full shadow-md">
                                            {{ $recipe->ingredients->count() }} ingredients
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Recipe Content -->
                                <div class="p-5 sm:p-6">
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-200 line-clamp-2">
                                        {{ $recipe->title }}
                                    </h3>
                                    
                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-amber-500 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                            {{ substr($recipe->user->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium">{{ $recipe->user->name }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                        </div>
                                        <span class="text-orange-600 dark:text-orange-400 font-semibold text-sm group-hover:translate-x-1 transition-transform duration-200">
                                            View Recipe →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-16 sm:py-20 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-2xl border-2 border-dashed border-orange-200 dark:border-orange-800">
                                    <div class="text-6xl sm:text-7xl mb-4">👨‍🍳</div>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                        No recipes yet
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                                        Be the first to share a delicious recipe!
                                    </p>
                                    @auth
                                        <a href="{{ route('recipes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Add Your First Recipe
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>

        <!-- Modern Footer -->
        <footer class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-t border-orange-200/50 dark:border-gray-700/50 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg flex items-center justify-center">
                            <span class="text-xl">🍳</span>
                        </div>
                        <span class="font-semibold text-gray-900 dark:text-white">Ingrentlicious</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                        &copy; {{ date('Y') }} Ingrentlicious. Made with <span class="text-red-500">❤️</span> and Laravel
                    </p>
                </div>
            </div>
        </footer>
    </div>
    
    @livewireScripts
</body>
</html>
