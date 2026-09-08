<?php

use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'profile']);

    Route::apiResource('products', ProductController::class);
});