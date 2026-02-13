<?php

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

new class extends Component {
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => $this->currentPasswordRules(),
                'password' => $this->passwordRules(),
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => $validated['password'],
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<x-pages::settings.layout :heading="__('Update Password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
    <section class="w-full">
        <form method="POST" wire:submit="updatePassword" class="space-y-6">
            <!-- Current Password -->
            <div class="space-y-2">
                <label for="current_password" class="block text-sm font-semibold text-gray-900 dark:text-white">
                    {{ __('Current password') }}
                </label>
                <input 
                    wire:model="current_password" 
                    id="current_password"
                    type="password" 
                    required 
                    autocomplete="current-password"
                    class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                />
                @error('current_password')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white">
                    {{ __('New password') }}
                </label>
                <input 
                    wire:model="password" 
                    id="password"
                    type="password" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                />
                @error('password')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror
                
                <!-- Password Requirements -->
                <div class="mt-3 p-4 bg-orange-50 dark:bg-orange-900/10 border border-orange-200 dark:border-orange-800 rounded-xl">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Password must contain:</p>
                    <ul class="space-y-2">
                        <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>More than 8 characters (12+ recommended)</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>One uppercase letter (A-Z)</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>One lowercase letter (a-z)</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>One number (0-9)</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>One special character (!@#$%^&*)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 dark:text-white">
                    {{ __('Confirm Password') }}
                </label>
                <input 
                    wire:model="password_confirmation" 
                    id="password_confirmation"
                    type="password" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                />
                @error('password_confirmation')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    data-test="update-password-button"
                >
                    <span wire:loading.remove>{{ __('Update Password') }}</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Updating...') }}
                    </span>
                </button>

                <div 
                    x-data="{ show: false }"
                    x-on:password-updated.window="show = true; setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    style="display: none;"
                    class="flex items-center gap-2 text-sm font-medium text-green-600 dark:text-green-400"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ __('Saved.') }}
                </div>
            </div>
        </form>
    </section>
</x-pages::settings.layout>
