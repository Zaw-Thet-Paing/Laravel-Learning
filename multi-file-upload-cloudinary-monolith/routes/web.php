<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// admin dashboard
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/catgories/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Product
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products/{id}/details', [ProductController::class, 'show'])->name('admin.product.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    // Image delete
    Route::get('/photo/{id}', [ProductController::class, 'deletePhoto'])->name('admin.photo.delete');
});

// user
Route::middleware(['auth', 'user'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.home');
    Route::get('/{category}', [UserController::class, 'productByCategory'])->name('user.productByCategory');
    Route::get('/products/{id}/details', [UserController::class, 'productDetails'])->name('user.productDetails');
});
