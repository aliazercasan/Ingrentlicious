<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings - Ingrentlicious</title>
    @include('partials.head')
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
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors duration-200">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="px-3 py-2 sm:px-4 text-sm sm:text-base text-orange-600 dark:text-orange-400 font-semibold">
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
                <!-- Settings Navigation Tabs -->
                <div class="mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-2 inline-flex flex-wrap gap-2">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-gray-700' }}">
                            Profile
                        </a>
                        <a href="{{ route('user-password.edit') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('user-password.edit') ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-gray-700' }}">
                            Password
                        </a>
                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <a href="{{ route('two-factor.show') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('two-factor.show') ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-gray-700' }}">
                                Two-Factor Auth
                            </a>
                        @endif
                        <a href="{{ route('appearance.edit') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('appearance.edit') ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-gray-700' }}">
                            Appearance
                        </a>
                    </div>
                </div>

                <!-- Settings Content Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 sm:p-8 lg:p-10">
                        <div class="max-w-3xl">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $heading ?? '' }}</h1>
                            <p class="text-gray-600 dark:text-gray-400 mb-8">{{ $subheading ?? '' }}</p>
                            
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @fluxScripts
</body>
</html>
