<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Livewire\{Cart, Market};
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('front');
})->name('home');


Route::get('dashboard', function () {
        if (! Auth::user()?->is_admin) {
            return redirect()->route('market');
        }
        return view('dashboard');
    })
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/market', Market::class)
    ->middleware(['auth', 'verified'])
    ->name('market');

Route::get('/my-cart', Cart::class)
    ->middleware(['auth', 'verified'])
    ->name('cart');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
