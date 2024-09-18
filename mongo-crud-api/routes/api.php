<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('login');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::get('/posts', [PostController::class, 'index']);
    // Route::post('/posts', [PostController::class, 'store']);
    // Route::get('/posts/{id}', [PostController::class, 'show']);
    // Route::put('/posts/{id}', [PostController::class, 'update']);
    // Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    Route::resource('posts', PostController::class);

});
