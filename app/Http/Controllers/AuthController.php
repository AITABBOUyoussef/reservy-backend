<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoogleLoginRequest as RequestsGoogleLoginRequest;
use App\Models\User;
use App\Requests\ForgotPasswordRequest;
use App\Requests\GoogleLoginRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Requests\InscriptionRequest;
use App\Requests\LoginRequest;
use App\Requests\ResetPasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// Initialise le composant et ses d?pendances.
    public function __construct(
        protected AuthService $authService
    ) {}

// G?re l?op?ration d?authentification.
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie.',
            'token'   => $data['token'],
            'user'    => $data['user'],
            'role' => $data['Role'],
        ], 200);
    }
// G?re l?op?ration d?authentification.
    public function inscription(InscriptionRequest $request): JsonResponse
    {
        $data = $this->authService->inscription($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Inscription effectuée avec succès.',
            'token'   => $data['token'],
            'user'    => $data['user'],
            'role' => $data['Role'],

        ], 201);
    }

// G?re l?op?ration d?authentification.
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
// Cr?e une nouvelle ressource.
    public function store(Request $request)
    {
        //
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
// G?re l?op?ration d?authentification.
    public function googleLogin(GoogleLoginRequest $request): JsonResponse
    {
        $data = $this->authService->googleLogin($request->validated());

        return response()->json([
            'success' => true,
            'message' => $data['message'],
            'token'   => $data['token'],
            'user'    => $data['user'],
            'role' => $data['Role'],

        ], 200);
    }
// G?re l?op?ration d?authentification.
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $data = $this->authService->forgotPassword($request->validated());

        return response()->json([
            'success' => $data['success'],
            'message' => $data['message'],
        ], 200);
    }

// G?re l?op?ration d?authentification.
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->resetPassword($request->validated());

            return response()->json([
                'success' => true,
                'message' => $result['message']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
