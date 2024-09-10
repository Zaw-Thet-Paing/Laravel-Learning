<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('login');


Route::middleware('auth:sanctum')->group(function(){
    // authenticated routes
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gallery CRUD
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::post('/gallery', [GalleryController::class, 'store']);
    Route::get('/gallery/{id}', [GalleryController::class, 'show']);
    Route::put('/gallery/{id}', [GalleryController::class, 'update']);
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy']);
});
