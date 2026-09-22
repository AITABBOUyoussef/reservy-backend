<?php

namespace App\Http\Controllers;

use App\Requests\DeletOptionEtablissementRequests;
use App\Requests\ProduitOptionRequests;
use App\Services\ProduitOptionService;
use Illuminate\Http\Request;

class ProduitOption extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function __construct(protected ProduitOptionService $optionService) {}

    public function store(ProduitOptionRequests $request)
    {
 $data = $this->optionService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Option du produit ajoutée avec succès.',
            'ProuitOption' => $data['option'],
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function index(Request $request)
    {

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
    public function destroy(DeletOptionEtablissementRequests $request)
    {
        $this->optionService->destroy($request->validated());
 return response()->json([
            'success' => true,
            'message' => 'Tabl Delete'
        ], 200);
    }
}
