<?php

use Livewire\Component;

new class extends Component {
    //
}; ?>

<x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Customize how Ingrentlicious looks on your device')">
    <section class="w-full">
        <div class="space-y-6">
            <div>
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Choose your preferred theme</h3>
                
                <div x-data="{ theme: $flux.appearance }" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Light Theme -->
                    <button 
                        type="button"
                        @click="$flux.appearance = 'light'; theme = 'light'"
                        :class="theme === 'light' ? 'ring-2 ring-orange-500 border-orange-500' : 'border-gray-300 dark:border-gray-600'"
                        class="relative p-6 bg-white dark:bg-gray-900 border-2 rounded-xl hover:border-orange-400 transition-all duration-200 group"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-amber-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-gray-900 dark:text-white">Light</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Bright and clear</p>
                            </div>
                        </div>
                        <div 
                            x-show="theme === 'light'"
                            class="absolute top-3 right-3 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </button>

                    <!-- Dark Theme -->
                    <button 
                        type="button"
                        @click="$flux.appearance = 'dark'; theme = 'dark'"
                        :class="theme === 'dark' ? 'ring-2 ring-orange-500 border-orange-500' : 'border-gray-300 dark:border-gray-600'"
                        class="relative p-6 bg-white dark:bg-gray-900 border-2 rounded-xl hover:border-orange-400 transition-all duration-200 group"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-700 to-gray-900 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-gray-900 dark:text-white">Dark</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Easy on the eyes</p>
                            </div>
                        </div>
                        <div 
                            x-show="theme === 'dark'"
                            class="absolute top-3 right-3 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </button>

                    <!-- System Theme -->
                    <button 
                        type="button"
                        @click="$flux.appearance = 'system'; theme = 'system'"
                        :class="theme === 'system' ? 'ring-2 ring-orange-500 border-orange-500' : 'border-gray-300 dark:border-gray-600'"
                        class="relative p-6 bg-white dark:bg-gray-900 border-2 rounded-xl hover:border-orange-400 transition-all duration-200 group"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-gray-900 dark:text-white">System</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Match your device</p>
                            </div>
                        </div>
                        <div 
                            x-show="theme === 'system'"
                            class="absolute top-3 right-3 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        Your theme preference is saved automatically and will be applied across all your devices when you're signed in.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-pages::settings.layout>
