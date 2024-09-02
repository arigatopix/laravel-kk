<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/login', function () {
    return Socialite::driver('keycloak')->redirect();
});

Route::get('/auth/callback', function () {
    $kUser = Socialite::driver('keycloak')->user();

    $token = $kUser->token;
    $refreshToken = $kUser->refreshToken;
    $expiresIn = $kUser->expiresIn;

    $user = User::updateOrCreate([
        'github_id' => $kUser->id,
    ], [
        'name' => $kUser->name,
        'email' => $kUser->email,
        'password' => $kUser->email,
    ]);

    Auth::login($user);

    return redirect()->intended('/api/hello');
});

Route::get('/auth/logout', function () {
    Auth::logout();
    // return redirect(Socialite::driver('keycloak'));
});
