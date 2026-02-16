<div>
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

    @if($recipes->hasPages())
        <div class="mt-8 sm:mt-12">
            {{ $recipes->links() }}
        </div>
    @endif
</div>
