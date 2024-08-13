<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;


// routes/api.php
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::middleware('check.token')->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']); // Tambahkan endpoint /employees di sini
});

