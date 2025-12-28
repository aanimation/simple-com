<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\{User, CartItem};
use App\Observers\{UserObserver, CartItemObserver};

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
        User::observe(UserObserver::class);
        CartItem::observe(CartItemObserver::class);
    }
}
