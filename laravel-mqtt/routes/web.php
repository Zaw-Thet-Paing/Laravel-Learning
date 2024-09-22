<?php

use App\Http\Controllers\MqttController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mqtt/publish', [MqttController::class, 'publish']);
Route::get('/mqtt/subscribe', [MqttController::class, 'subscribe']);
