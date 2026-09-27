<?php

namespace App\Http\Controllers;

use App\Requests\CategorieEtablissementRequests;
use App\Requests\DeletCategorieEtablissementRequests;
use App\Services\CategorieEtablissementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategorieEtablissement extends Controller
{
// Initialise le composant et ses d?pendances.
    public function __construct(protected CategorieEtablissementService $categorieService) {}

// Ex?cute l?op?ration ? AddCategorie ?.
    public function AddCategorie(CategorieEtablissementRequests $request): JsonResponse
    {
        $data = $this->categorieService->addCategorie($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Catégorie ajoutée avec succès.',
            'categorie' => $data['categorie'],
        ], 201);
    }
// Ex?cute l?op?ration ? DeletCategorie ?.
    public function DeletCategorie(DeletCategorieEtablissementRequests $request): JsonResponse
    {
        $this->categorieService->deleteCategorie($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Categorie Delete'
        ], 200);
    }
}
