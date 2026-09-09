<?php

namespace App\Http\Controllers;

use App\Requests\AcceptEtablissementRequest;
use App\Requests\CreeEtablissementRequest;
use App\Services\CreeEtablissementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreeEtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected CreeEtablissementService $etablissementService ) {}


    public function EtablissementAttente()
    {
        $data = $this->etablissementService->EtablissementAttente();
     return response()->json([

            'message' => 'les etablissements en_attente.',
            'Etablissement_en_attente'    => $data['Etablissement_en_attente'],
        ], 200);
    }
    public function AcceptEtablissement(AcceptEtablissementRequest $request) : JsonResponse
    {
         $data = $this->etablissementService->AcceptEtablissement($request->validated());
     return response()->json([
            'message' => 'Accepte etablissement réussie.',
            'etablissement'    => $data['etablissement'],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreeEtablissementRequest $request) : JsonResponse
    {

$data = $this->etablissementService->CreeEtablissement($request->validated());
     return response()->json([
        'success' => true,
            'message' => 'Cree etablissement réussie.',
            'etablissement'    => $data['etablissement'],
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
    public function destroy(string $id)
    {
        //
    }
}
