<?php

namespace App\Http\Controllers;


use App\Requests\TablEtablissementRequests;
use App\Requests\DeletTablEtablissementRequests;
use App\Requests\EditEtablissementRequests;
use App\Requests\EditTablEtablissementRequests;
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
     public function EditTabl(EditTablEtablissementRequests $request) : JsonResponse
    {
        $data = $this->etablissemenTablService->EditTabl($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Edit Tabl de Etablissement réussie.',
            'tabl'    => $data['tabl'],
        ], 200);
    }


      public function daleteTabl(DeletTablEtablissementRequests $request): JsonResponse
    {
        $this->etablissemenTablService->daleteTabl($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tabl Delete'
        ], 200);
    }


}
