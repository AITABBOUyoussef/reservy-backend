<?php

namespace App\Http\Controllers;

use App\Requests\CategorieEtablissementRequests;
use App\Services\CategorieEtablissementService;
use Illuminate\Http\JsonResponse;

class CategorieEtablissement extends Controller
{
    // Injection dyal Service
    public function __construct(protected CategorieEtablissementService $categorieService) {}

    public function AddCategorie(CategorieEtablissementRequests $request): JsonResponse
    {
        $data = $this->categorieService->addCategorie($request->validated());
   return response()->json([
            'success' => true,
            'message' => 'Catégorie ajoutée avec succès.',
            'categorie' => $data['categorie'],
        ], 201);
    }
}
