<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public route
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedController::class, 'login']);
Route::get('/unauthenticated', [AuthenticatedController::class, 'unauthenticated'])->name('login');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthenticatedController::class, 'logout']);
});

//Admin Routes
Route::middleware(['auth:sanctum', 'admin'])->group(function(){

});

//User Routes
Route::middleware(['auth:sanctum', 'user'])->group(function(){

});
