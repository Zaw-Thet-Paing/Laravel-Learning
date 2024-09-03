<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin side
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
});

// user side
Route::middleware(['auth', 'user'])->group(function(){
    Route::get('/user/dashboard', [UserHomeController::class, 'index'])->name('user.dashboard');
});

// access from both users
Route::middleware('auth')->group(function(){
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
});
