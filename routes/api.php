<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieEtablissement;
use App\Http\Controllers\CreeEtablissementController;
use App\Http\Controllers\ImageEtablissement;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProduitImageController;
use App\Http\Controllers\ProduitOption;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TablEtablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/Register', [AuthController::class, 'inscription']);
Route::get('/GetEtablissement', [CreeEtablissementController::class, 'getEtablissement']);
Route::post('/GetEtablissementDet', [CreeEtablissementController::class, 'getEtablissementDet']);


Route::middleware('auth:sanctum')->group(function () {
Route::middleware('role:admin')->group(function () {
  Route::post('/DestroyEtablissement', [CreeEtablissementController::class, 'destroy']);
    Route::get('/EtablissementAttente', [CreeEtablissementController::class, 'EtablissementAttente']);
    Route::get('/AllEtablissement', [CreeEtablissementController::class, 'getAllEtablissement']);
    Route::post('/AcceptEtablissement', [CreeEtablissementController::class, 'AcceptEtablissement']);
        Route::post('/CreeEtablissement', [CreeEtablissementController::class, 'store']);
    Route::post('/EditEtablissement', [CreeEtablissementController::class, 'EditEtablissement']);
    Route::post('/AddImage', [ImageEtablissement::class, 'store']);
    Route::post('/AddTabl', [TablEtablissement::class, 'AddTabl']);
    Route::post('/DaleteTabl', [TablEtablissement::class, 'daleteTabl']);
    Route::post('/DaleteImage', [ImageEtablissement::class, 'destroy']);

});
Route::middleware('role:admin|gerant')->group(function () {
    Route::post('/EditEtablissement', [CreeEtablissementController::class, 'EditEtablissement']);
    Route::post('/AddImage', [ImageEtablissement::class, 'store']);
    Route::post('/AddTabl', [TablEtablissement::class, 'AddTabl']);
    Route::post('/EditTabl', [TablEtablissement::class, 'EditTabl']);
    Route::post('/DaleteTabl', [TablEtablissement::class, 'daleteTabl']);
    Route::post('/DaleteImage', [ImageEtablissement::class, 'destroy']);
    Route::post('/EditImage', [ImageEtablissement::class, 'EditImage']);
    Route::get('/MonEtablissment', [CreeEtablissementController::class, 'getEtablissementGarant']);
    Route::post('/AddCategorie', [CategorieEtablissement::class, 'AddCategorie']);
    Route::post('/DeletCategorie', [CategorieEtablissement::class, 'DeletCategorie']);
    Route::get('/GetProduits/{etablissementId}', [ProduitController::class, 'index']);
    Route::post('/AddProduit', [ProduitController::class, 'addProduit']);
    Route::post('/EditProduit', [ProduitController::class, 'editProduit']);
    Route::post('/DeletProduit', [ProduitController::class, 'deleteProduit']);
    Route::post('/AddProduitImage', [ProduitImageController::class, 'store']);
    Route::post('/AddProduitOption', [ProduitOption::class, 'store']);
    Route::post('/DeletProduitImage', [ProduitImageController::class, 'destroy']);
    Route::post('/DeletProduitOption', [ProduitOption::class, 'destroy']);
    Route::post('/EditProduitImage', [ProduitImageController::class, 'setMain']);
});
    Route::post('/CreeEtablissement', [CreeEtablissementController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/editProfil', [ProfilController::class, 'store']);
    Route::post('/destroy', [ProfilController::class, 'destroy']);
    Route::apiResource('reservations', ReservationController::class);
});
