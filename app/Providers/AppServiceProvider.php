<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Cloudinary::class, function () {
            return new Cloudinary(config('services.cloudinary.url'));
        });
    }

    public function boot(): void
    {
        User::observe(UserObserver::class);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}