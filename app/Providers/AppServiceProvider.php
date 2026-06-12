<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Event;
use App\Listeners\LogActivityListener;
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
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        // Mendaftarkan listener untuk event autentikasi
        Event::listen(
            [
                \Illuminate\Auth\Events\Login::class,
                \Illuminate\Auth\Events\Failed::class,
                \Illuminate\Auth\Events\Logout::class,
                \Illuminate\Auth\Events\Registered::class,
                \Illuminate\Auth\Events\PasswordReset::class,
            ],
            LogActivityListener::class
        );
    }
}
