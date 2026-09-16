<?php

namespace App\Http\Controllers;

use App\Requests\EditProfilRequest;
use App\Services\ProfilService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfilController extends Controller
{

    public function __construct(
        protected ProfilService $profilService
    ){}




    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EditProfilRequest $request): JsonResponse
    {
    // dd($request->all());
    $data = $this->profilService->editProfil($request->user(), $request->validated());
        return response()->json([
        'success' => true,
            'message' => 'Profil mis à jour avec succès.',
            // 'token'   => $data['token'],
            'user'    => $data['user'],
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
    public function destroy(Request $request)
    {
    $this->profilService->destroy($request->user());

        return response()->json([
            'success' => true,
            'message' => 'destroy réussie.'
        ], 200);
    }
}
