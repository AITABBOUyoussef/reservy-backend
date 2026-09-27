<?php

namespace App\Http\Controllers;

use App\Requests\CommandeItemRequest;
use App\Services\CommandeItemService;
use Illuminate\Http\JsonResponse;

class CommandeItemController extends Controller
{
// Initialise le composant et ses d?pendances.
    public function __construct(protected CommandeItemService $commandeItemService) {}

// Cr?e une nouvelle ressource.
    public function store(CommandeItemRequest $request): JsonResponse
    {
        $commandeItem = $this->commandeItemService->createCommandeItem(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté à la commande avec succès.',
            'commande_item' => $commandeItem,
        ], 201);
    }
// R?cup?re une ressource.
    public function get()
    {
        $data =  $this->commandeItemService->getCommande();
        return response()->json([
            'MesCommande'    => $data['commande_items'],
        ], 200);
    }
}
