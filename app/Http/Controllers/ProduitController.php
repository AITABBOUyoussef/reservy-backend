<?php

namespace App\Http\Controllers;

use App\Requests\DeletProduitRequests;
use App\Requests\EditProduitRequests;
use App\Requests\ProduitRequests;
use App\Services\ProduitService;
use Illuminate\Http\JsonResponse;

class ProduitController extends Controller
{
    public function __construct(protected ProduitService $produitService) {}

    public function index(int $etablissementId): JsonResponse
    {
        $data = $this->produitService->getProduits($etablissementId);

        return response()->json([
            'success' => true,
            'produits' => $data['produits'],
        ], 200);
    }

    public function addProduit(ProduitRequests $request): JsonResponse
    {
        $data = $this->produitService->addProduit($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté avec succès.',
            'produit' => $data['produit'],
        ], 201);
    }

    public function editProduit(EditProduitRequests $request): JsonResponse
    {
        $data = $this->produitService->editProduit($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Produit modifié avec succès.',
            'produit' => $data['produit'],
        ], 200);
    }

    public function deleteProduit(DeletProduitRequests $request): JsonResponse
    {
        $this->produitService->deleteProduit($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Produit supprimé avec succès.',
        ], 200);
    }
}
