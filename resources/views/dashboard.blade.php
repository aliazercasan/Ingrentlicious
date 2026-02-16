<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Ingrentlicious</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Modern Header -->
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
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-orange-600 dark:text-orange-400 font-semibold">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="hidden sm:inline-block px-3 py-2 sm:px-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors duration-200">
                            Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 font-medium transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <!-- Welcome Section -->
                <div class="bg-gradient-to-r from-orange-500 to-amber-600 rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10 mb-8 text-white">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex-1">
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2">
                                Welcome back, {{ auth()->user()->name }}! 🍳
                            </h1>
                            <p class="text-base sm:text-lg opacity-90">
                                Your friendly recipe assistant is ready to help you explore and share delicious recipes.
                            </p>
                        </div>
                        <a href="{{ route('recipes.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-white text-orange-600 rounded-xl hover:bg-orange-50 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Recipe
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    <!-- Your Recipes Card -->
                    <a href="{{ route('my-recipes') }}" class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-amber-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-3xl">📖</span>
                                </div>
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Your Recipes
                            </h3>
                            <p class="text-4xl font-bold text-orange-600 dark:text-orange-400 mb-2">
                                {{ auth()->user()->recipes()->count() }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                recipes shared
                            </p>
                        </div>
                    </a>

                    <!-- Visitor Views Card -->
                    <a href="{{ route('recipe-views') }}" class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-3xl">👁️</span>
                                </div>
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Visitor Views
                            </h3>
                            <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                                {{ number_format(auth()->user()->recipes()->sum('views')) }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                total views
                            </p>
                        </div>
                    </a>

                    <!-- Quick Actions Card -->
                    <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="p-6 sm:p-8 text-white">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg mb-4">
                                <span class="text-3xl">⚡</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-4">
                                Quick Actions
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ route('recipes.create') }}" class="block w-full px-4 py-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-lg text-sm font-medium transition-colors duration-200">
                                    + Create Recipe
                                </a>
                                <a href="{{ route('recipes.index') }}" class="block w-full px-4 py-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-lg text-sm font-medium transition-colors duration-200">
                                    Browse All Recipes
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-lg text-sm font-medium transition-colors duration-200">
                                    Account Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
