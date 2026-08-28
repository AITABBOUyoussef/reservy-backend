<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/Register', [AuthController::class, 'inscription']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/editProfil', [ProfilController::class, 'store']);
    Route::post('/destroy', [ProfilController::class, 'destroy']);
});
