<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// In .env file, set SESSION_DRIVER=cookie cuz it is simple session auth
// edit bootstrap > app.php
// edit app > Providers > AppServiceProvider.php
Route::middleware('web')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/home', [AuthController::class, 'home']);
});

