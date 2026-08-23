<?php

namespace App\Http\Controllers;

use App\Requests\InscriptionRequest;
use App\Requests\LoginRequest;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected AuthService $authService
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());
        return response()->json([
        'success' => true,
            'message' => 'Connexion réussie.',
            'token'   => $data['token'],
            'user'    => $data['user'],
        ], 200);
    }
  public function inscription(InscriptionRequest $request): JsonResponse
{
    $data = $this->authService->inscription($request->validated());

    return response()->json([
        'success' => true,
        'message' => 'Inscription effectuée avec succès.',
        'token'   => $data['token'],
        'user'    => $data['user'],
    ], 201);
}

  public function logout(Request $request)
    {
    $this->authService->logout($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie.'
        ], 200);
    }
    public function destroy(Request $request)
    {
    $this->authService->destroy($request->user());

        return response()->json([
            'success' => true,
            'message' => 'destroy réussie.'
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

}
