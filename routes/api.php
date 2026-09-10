<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreeEtablissementController;
use App\Http\Controllers\ProfilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/Register', [AuthController::class, 'inscription']);
    Route::get('/GetEtablissement', [CreeEtablissementController::class, 'getEtablissement']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/editProfil', [ProfilController::class, 'store']);
    Route::post('/destroy', [ProfilController::class, 'destroy']);
    Route::post('/CreeEtablissement', [CreeEtablissementController::class, 'store']);
    Route::post('/AcceptEtablissement', [CreeEtablissementController::class, 'AcceptEtablissement']);
    Route::post('/EditEtablissement', [CreeEtablissementController::class, 'EditEtablissement']);
    Route::post('/DestroyEtablissement', [CreeEtablissementController::class, 'destroy']);
    Route::get('/EtablissementAttente', [CreeEtablissementController::class, 'EtablissementAttente']);
    Route::get('/AllEtablissement', [CreeEtablissementController::class, 'getAllEtablissement']);
});
