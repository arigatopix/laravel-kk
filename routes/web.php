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

    $user = User::updateOrCreate([
        'email' => $kUser->email,
        'name' => $kUser->name,
        'password' => "1234",

    ]);

    Auth::login($user);

    return response()->json($kUser, 200);
});

Route::get('/auth/logout', function () {
    Auth::logout();
    // return redirect(Socialite::driver('keycloak'));
});
