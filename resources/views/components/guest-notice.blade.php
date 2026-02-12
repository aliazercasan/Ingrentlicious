@guest
<div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-blue-700 dark:text-blue-300">
                You're browsing as a guest. 
                <a href="{{ route('register') }}" class="font-medium underline hover:text-blue-600">Register</a> or 
                <a href="{{ route('login') }}" class="font-medium underline hover:text-blue-600">log in</a> 
                to add your own recipes.
            </p>
        </div>
    </div>
</div>
@endguest
