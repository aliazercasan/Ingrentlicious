<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            
            // Force the correct Railway domain
            $railwayUrl = env('RAILWAY_PUBLIC_DOMAIN');
            if ($railwayUrl) {
                $fullUrl = 'https://' . $railwayUrl;
                \Illuminate\Support\Facades\URL::forceRootUrl($fullUrl);
                config(['app.url' => $fullUrl]);
            } elseif ($appUrl = config('app.url')) {
                \Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
            }
            
            // Ensure secure cookies in production
            config(['session.secure' => true]);
            config(['session.http_only' => true]);
            config(['session.same_site' => 'lax']);
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => 
            Password::min(9)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
        );
    }
}
