<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\DashboardController;

Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth.basic');

Route::middleware('auth.basic')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile/delete', [ProfileController::class, 'delete']);

    Route::get('/book/movein', [JasaController::class, 'movein']);
    Route::get('/book/packin', [JasaController::class, 'packin']);
    Route::put('/book/edit/{id}', [JasaController::class, 'update']);
    Route::delete('/book/delete', [JasaController::class, 'delete']);
    Route::post('/checkout', [JasaController::class, 'store']);
    Route::get('/payment/movein', [JasaController::class, 'paymentMovein']);
    Route::get('/payment/packin', [JasaController::class, 'paymentPackin']);
    Route::get('/history', [JasaController::class, 'history']);
});

use App\Http\Controllers\BookingController;

Route::prefix('v1')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
});

