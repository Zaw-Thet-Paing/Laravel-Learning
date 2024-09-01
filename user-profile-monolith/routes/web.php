<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login_page'])->name('login');
Route::get('/register', [RegisterController::class, 'register_page'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePasswordPage');
    Route::post('/profile/changePassword', [ProfileController::class, 'updatePassword'])->name('profile.changePassword');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
