<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function(){
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/', Profile::class)->name('profile');
});
