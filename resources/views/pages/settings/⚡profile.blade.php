<?php

use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    use ProfileValidationRules;

    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate($this->profileRules($user->id));

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }
}; ?>

<x-pages::settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
    <section class="w-full">
        <form wire:submit="updateProfileInformation" class="space-y-6">
            <!-- Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white">
                    {{ __('Name') }}
                </label>
                <input 
                    wire:model="name" 
                    id="name"
                    type="text" 
                    required 
                    autofocus 
                    autocomplete="name"
                    class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                />
                @error('name')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white">
                    {{ __('Email') }}
                </label>
                <input 
                    wire:model="email" 
                    id="email"
                    type="email" 
                    required 
                    autocomplete="email"
                    class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                />
                @error('email')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                @enderror

                @if ($this->hasUnverifiedEmail)
                    <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-amber-800 dark:text-amber-200">
                                    {{ __('Your email address is unverified.') }}
                                </p>
                                <button 
                                    type="button"
                                    wire:click.prevent="resendVerificationNotification"
                                    class="mt-2 text-sm font-medium text-amber-700 dark:text-amber-300 hover:text-amber-900 dark:hover:text-amber-100 underline transition-colors duration-200"
                                >
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-3 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                <p class="text-sm text-green-800 dark:text-green-200 font-medium">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-xl hover:from-orange-600 hover:to-amber-700 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    data-test="update-profile-button"
                >
                    <span wire:loading.remove>{{ __('Save Changes') }}</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Saving...') }}
                    </span>
                </button>

                <div 
                    x-data="{ show: false }"
                    x-on:profile-updated.window="show = true; setTimeout(() => show = false, 3000)"
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

        @if ($this->showDeleteUser)
            <div class="mt-12 pt-12 border-t border-gray-200 dark:border-gray-700">
                <livewire:pages::settings.delete-user-form />
            </div>
        @endif
    </section>
</x-pages::settings.layout>
