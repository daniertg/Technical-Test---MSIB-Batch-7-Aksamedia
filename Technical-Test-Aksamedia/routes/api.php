<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// routes/api.php
Route::middleware('check.token')->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{uuid}', [EmployeeController::class, 'update']); // Tambahkan endpoint PUT di sini
});


