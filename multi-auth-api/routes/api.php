<?php


use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
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
    // categories
    Route::get('/admin/categories', [AdminCategoryController::class, 'index']);// get all categories
    Route::get('/admin/categories/{id}', [AdminCategoryController::class, 'show']); //get category by id
    Route::post('/admin/categories', [AdminCategoryController::class, 'store']); //create category
    Route::put('/admin/categories/{id}', [AdminCategoryController::class, 'update']); //update category by id
    Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy']); //delete category by id

    // products
    Route::get('/admin/products', [AdminProductController::class, 'index']);
    Route::get('/admin/products/{id}', [AdminProductController::class, 'show']);
    Route::post('/admin/products', [AdminProductController::class, 'store']);
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update']);
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy']);
});

//User Routes
Route::middleware(['auth:sanctum', 'user'])->group(function(){
    // categories
    Route::get('/user/categories', [UserCategoryController::class, 'index']);

    // products
    Route::get('/user/products', [UserProductController::class, 'index']);
});
