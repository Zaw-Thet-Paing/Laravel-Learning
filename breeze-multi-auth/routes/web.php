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

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');
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
