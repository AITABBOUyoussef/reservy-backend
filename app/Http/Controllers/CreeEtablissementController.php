<?php

namespace App\Http\Controllers;

use App\Requests\AcceptEtablissementRequest;
use App\Requests\CreeEtablissementRequest;
use App\Requests\DestroyEtablissementRequests;
use App\Requests\EditEtablissementRequests;
use App\Requests\GarantEtablissementRequests;
use App\Services\CreeEtablissementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreeEtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// Initialise le composant et ses d?pendances.
    public function __construct(protected CreeEtablissementService $etablissementService) {}


// Ex?cute l?op?ration ? EtablissementAttente ?.
    public function EtablissementAttente()
    {
        $data = $this->etablissementService->EtablissementAttente();
        return response()->json([

            'message' => 'les etablissements en_attente.',
            'Etablissement_en_attente'    => $data['Etablissement_en_attente'],
        ], 200);
    }
// R?cup?re une ressource.
    public function getAllEtablissement(Request $request)
    {
        $data = $this->etablissementService->getAllEtablissement($request->user());
        return response()->json([

            'message' => 'les etablissements ',
            'Etablissement'    => $data['Etablissement'],
        ], 200);
    }
// R?cup?re une ressource.
    public function getEtablissement()
    {
        $data = $this->etablissementService->getEtablissement();
        return response()->json([

            'message' => 'les etablissements ',
            'etablissements'    => $data['etablissements'],
        ], 200);
    }
// R?cup?re une ressource.
    public function getEtablissementGarant(Request $request)
    {

        $data['gerant_id'] = $request->user()->id;
        $dataa = $this->etablissementService->getEtablissementGarant($data);

        return response()->json([

            'message' => $dataa['msg'],
            'etablissements'    => $dataa['etablissements'],
        ], 200);
    }
// R?cup?re une ressource.
    public function getEtablissementDet(Request $request): JsonResponse
    {
        $data = $request->validate([
            'etablissementId' => 'required|integer|exists:etablissements,id',
        ]);
        $data['etablissementId'] = $request->etablissementId;
        $result = $this->etablissementService->getEtablissementDet($data);
        return response()->json([

            'message' => 'les etablissements ',
            'etablissements'    => $result['etablissements'],
        ], 200);
    }
// Ex?cute l?op?ration ? AcceptEtablissement ?.
    public function AcceptEtablissement(AcceptEtablissementRequest $request): JsonResponse
    {
        $data = $this->etablissementService->AcceptEtablissement($request->validated());
        return response()->json([
            'message' => 'Accepte etablissement réussie.',
            'etablissement'    => $data['etablissement'],
            'user'    => $data['user'],
        ], 200);
    }

// Met ? jour une ressource existante.
    public function EditEtablissement(EditEtablissementRequests $request): JsonResponse
    {
        $data = $this->etablissementService->EditEtablissement($request->validated());
        return response()->json([
            'message' => 'mise a jour etablissement réussie.',
            'etablissement'    => $data['etablissement'],
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
// Cr?e une nouvelle ressource.
    public function store(CreeEtablissementRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['gerant_id'] = $request->user()->id;
        $result = $this->etablissementService->CreeEtablissement($data);
        return response()->json([
            'success' => true,
            'message' => 'Cree etablissement réussie.',
            'etablissement'    => $result['etablissement'],
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
    public function destroy(DestroyEtablissementRequests $request)
    {

        $this->etablissementService->destroy($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'destroy réussie.'
        ], 200);
    }
}
