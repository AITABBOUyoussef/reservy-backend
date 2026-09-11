<?php

namespace App\Http\Controllers;

use App\Requests\DeletImageEtablissementRequests;
use App\Requests\ImageEtablissementRequests;
use App\Services\ImageEtablissementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageEtablissement extends Controller
{
     public function __construct(protected ImageEtablissementService $etablissemenImagetService ) {}


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(ImageEtablissementRequests $request) : JsonResponse
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletImageEtablissementRequests $request): JsonResponse
    {
      $this->etablissemenImagetService->daleteImage($request->validated());
          return response()->json([
            'success' => true,
            'message' => 'Image Delete'
        ], 200);
    }
}
