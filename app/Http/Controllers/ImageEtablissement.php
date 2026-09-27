<?php

namespace App\Http\Controllers;

use App\Requests\DeletImageEtablissementRequests;
use App\Requests\ImageEtablissementRequests;
use App\Services\ImageEtablissementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageEtablissement extends Controller
{
// Initialise le composant et ses d?pendances.
    public function __construct(protected ImageEtablissementService $etablissemenImagetService) {}


// Liste les ressources disponibles.
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
// Cr?e une nouvelle ressource.
    public function store(ImageEtablissementRequests $request): JsonResponse
    {

        $data = $this->etablissemenImagetService->AddImage($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Add Image de Etablissement réussie.',
            'image'    => $data['image'],
        ], 200);
    }


    /**
     * Display the specified resource.
     */
// R?cup?re une ressource.
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
// Met ? jour une ressource existante.
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
// Supprime une ressource.
    public function destroy(DeletImageEtablissementRequests $request): JsonResponse
    {
        $this->etablissemenImagetService->deleteImage($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Image Delete'
        ], 200);
    }
// Met ? jour une ressource existante.
    public function EditImage(DeletImageEtablissementRequests $request): JsonResponse
    {
        $this->etablissemenImagetService->EditImage($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Image principale mise à jour avec succès'
        ], 200);
    }
}
