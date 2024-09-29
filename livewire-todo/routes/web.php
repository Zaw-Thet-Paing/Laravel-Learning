<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\User\Home;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function(){
    Route::get('/', Login::class)->name('login');
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('auth.register');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', Home::class)->name('user.home');
});
