<?php

namespace App\Http\Controllers;

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


    public function index()
    {
        //
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
