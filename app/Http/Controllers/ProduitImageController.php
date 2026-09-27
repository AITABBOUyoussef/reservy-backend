<?php

namespace App\Http\Controllers;

use App\Requests\DeletProduitImageRequests;
use App\Requests\EditProduitImageRequests;
use App\Requests\ProduitImageRequests;
use App\Services\ProduitImageService;
use Illuminate\Http\JsonResponse;

class ProduitImageController extends Controller
{
// Initialise le composant et ses d?pendances.
    public function __construct(protected ProduitImageService $produitImageService) {}

// Cr?e une nouvelle ressource.
    public function store(ProduitImageRequests $request): JsonResponse
    {
        $data = $this->produitImageService->addImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Image du produit ajoutée avec succès.',
            'image' => $data['image'],
        ], 201);
    }

// Supprime une ressource.
    public function destroy(DeletProduitImageRequests $request): JsonResponse
    {
        $this->produitImageService->deleteImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Image du produit supprimée avec succès.',
        ]);
    }

// Pr?pare ou met ? jour les donn?es.
    public function setMain(EditProduitImageRequests $request): JsonResponse
    {
        $this->produitImageService->setMainImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Image principale du produit mise à jour avec succès.',
        ]);
    }
}
