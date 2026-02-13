<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 sm:mb-10">
            <div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                    @auth
                        Community Recipes
                    @else
                        All Recipes
                    @endauth
                </h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    @auth
                        Discover amazing dishes from other cooks
                    @else
                        Discover amazing dishes from our community
                    @endauth
                </p>
            </div>
            
            @auth
               
            @else
                <a href="{{ route('login') }}" class="w-full sm:w-auto text-center px-6 py-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-orange-600 dark:text-orange-400 rounded-xl hover:bg-white dark:hover:bg-gray-800 font-semibold shadow-md hover:shadow-lg transition-all duration-300 border border-orange-200 dark:border-orange-800">
                    Login to Add Recipe
                </a>
            @endauth
        </div>

        <div wire:loading class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @for ($i = 0; $i < 6; $i++)
                <div class="animate-pulse bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
                    <div class="h-48 sm:h-56 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="p-5 sm:p-6">
                        <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-4"></div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/2 mb-2"></div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
                    </div>
                </div>
            @endfor
        </div>

        <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @forelse ($recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe) }}" 
                   class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
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
                            @auth
                                No community recipes yet
                            @else
                                No recipes yet
                            @endauth
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            @auth
                                Check back later for recipes from other cooks!
                            @else
                                Be the first to share a delicious recipe!
                            @endauth
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
