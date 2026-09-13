<?php

namespace App\Http\Controllers;

use App\Requests\TablEtablissementRequests;
use App\Services\TablEtablissement as ServicesTablEtablissement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TablEtablissement extends Controller
{
     public function __construct(protected ServicesTablEtablissement $etablissemenTablService ) {}

     public function AddTabl(TablEtablissementRequests $request) : JsonResponse
    {

$data = $this->etablissemenTablService->AddTabl($request->validated());
     return response()->json([
        'success' => true,
            'message' => 'Add Tabl de Etablissement réussie.',
            'tabl'    => $data['tabl'],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */

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
    public function destroy(string $id)
    {
        //
    }
}
