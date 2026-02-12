<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingrentlicious - Your Recipe Assistant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        🍳 Ingrentlicious
                    </h1>
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Register
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h2 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        Your Friendly Recipe Assistant
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                        Explore delicious recipes, share your own creations, and cook with confidence
                    </p>
                    <a href="{{ route('recipes.index') }}" class="inline-block px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition">
                        Browse Recipes
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-8 mt-16">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="text-4xl mb-4">👀</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            View Recipes
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Browse through our collection of recipes with detailed ingredients and step-by-step instructions
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="text-4xl mb-4">✍️</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Share Your Recipes
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Register to add your own recipes and share your culinary creations with the community
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="text-4xl mb-4">🔒</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Manage Your Content
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Edit and delete your own recipes anytime. Your recipes, your control
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <p class="text-center text-gray-600 dark:text-gray-400">
                    &copy; {{ date('Y') }} Ingrentlicious. Made with ❤️ and Laravel
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
