<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return ':)';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/users', [UserController::class, 'showAll']);
