<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\AuthController;

// Rute untuk login (API)
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Rute yang memerlukan autentikasi menggunakan Sanctum
Route::middleware('check.token')->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
});
// Di routes/api.php
