@guest
<div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 border border-orange-200 dark:border-orange-800 rounded-xl p-4 sm:p-5 mb-6 sm:mb-8 backdrop-blur-sm">
    <div class="flex items-start gap-3 sm:gap-4">
        <div class="flex-shrink-0">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300">
                You're browsing as a guest. 
                <a href="{{ route('register') }}" class="font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline decoration-2 underline-offset-2 transition-colors duration-200">Register</a> or 
                <a href="{{ route('login') }}" class="font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 underline decoration-2 underline-offset-2 transition-colors duration-200">log in</a> 
                to add your own recipes.
            </p>
        </div>
    </div>
</div>
@endguest
