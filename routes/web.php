<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('reserveren')->group(function () {
    Route::get('/', [App\Http\Controllers\ReservationController::class, 'index'])->name('reserveren');
    Route::get('/nieuwe-reservering', [App\Http\Controllers\ReservationController::class, 'create'])->name('nieuwe-reservering');
    Route::post('/', [App\Http\Controllers\ReservationController::class, 'store']);
});


Route::get('/admin', [App\Http\Controllers\Admin\AdminReservationController::class, 'index'])->name('reservation')->middleware('auth');
