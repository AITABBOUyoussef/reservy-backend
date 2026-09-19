<?php

namespace App\Http\Controllers;

use App\Requests\DeletProduitImageRequests;
use App\Requests\ProduitImageRequests;
use App\Services\ProduitImageService;
use Illuminate\Http\JsonResponse;

class ProduitImageController extends Controller
{
    public function __construct(protected ProduitImageService $produitImageService) {}

    public function store(ProduitImageRequests $request): JsonResponse
    {
        $data = $this->produitImageService->addImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Image du produit ajoutée avec succès.',
            'image' => $data['image'],
        ], 201);
    }

    public function destroy(DeletProduitImageRequests $request): JsonResponse
    {
        $this->produitImageService->deleteImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Image du produit supprimée avec succès.',
        ]);
    }
}
