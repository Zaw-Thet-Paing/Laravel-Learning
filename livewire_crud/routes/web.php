<?php

use App\Livewire\AddCar;
use App\Livewire\CarList;
use App\Livewire\EditCar;
use App\Livewire\TestPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test/page', TestPage::class);
Route::get('/cars', CarList::class)->name('cars.home');
Route::get('/cars/create', AddCar::class)->name('cars.create');
Route::get('/cars/{id}/edit', EditCar::class)->name('cars.edit');
