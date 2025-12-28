<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (Auth::user()->email === 'admin@example.com') {
            return redirect()->intended('/dashboard');
        }

        return redirect()->intended('/market');
    }
}