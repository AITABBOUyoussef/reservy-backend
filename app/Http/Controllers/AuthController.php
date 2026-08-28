<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Requests\InscriptionRequest;
use App\Requests\LoginRequest;

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
    // public function destroy(Request $request)
    // {
    // $this->authService->destroy($request->user());

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'destroy réussie.'
    //     ], 200);
    // }
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
    public function googleLogin(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        try {
            // Socialite ghadi yched l'Token li siftat React w yt2ked mno m3a Google
            $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->token);

            // N9elbo 3la l'user f la base de données b l'email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Ila makaynch, n-creyiw compte jdid
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Mot de passe 3achwa2i 7it m-logi b Google
                ]);
            }

            // N-creyiw Token d Sanctum dyalna
            $token = $user->createToken('reservy_token')->plainTextToken;

            return response()->json([
                'message' => 'Connexion réussie avec Google',
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur de connexion avec Google',
                'error' => $e->getMessage()
            ], 401);
        }
    }
    public function forgotPassword(Request $request)
    {
        // 1. N-vérifiw wach l'email mktoub w wach kayn f la base de données
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Aucun compte ne correspond à cette adresse e-mail.'
        ]);

        // 2. N-creyiw Token 3achwa2i
        $token = Str::random(64);

        // 3. N-sauvegardew l'Token f la base de données (Table 'password_reset_tokens')
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // 4. Nsawbo l'Lien li ghadi ysift l'user l'React (Port 5173 dyalek)
        $resetLink = "http://localhost:5173/reset-password?token=" . $token . "&email=" . urlencode($request->email);

        // 5. Nsifto l'email (HTML basique)
        Mail::send([], [], function ($message) use ($request, $resetLink) {
            $message->to($request->email)
                    ->subject('Réinitialisation de votre mot de passe - Reservy')
                    ->html('
                        <h2>Bonjour,</h2>
                        <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
                        <p>Cliquez sur le lien ci-dessous pour créer un nouveau mot de passe :</p>
                        <a href="' . $resetLink . '" style="display:inline-block;padding:10px 20px;background-color:#b04121;color:white;text-decoration:none;border-radius:5px;">Changer mon mot de passe</a>
                        <p>Si vous n\'avez pas fait cette demande, ignorez cet e-mail.</p>
                    ');
        });

        return response()->json([
            'message' => 'Le lien de réinitialisation a été envoyé à votre adresse e-mail.'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        // 1. N-vérifiw les données li jaw mn React
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed', // "confirmed" kat-obliger ykoun m3aha "password_confirmation" f React
        ], [
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.'
        ]);

        // 2. N9elbo 3la l'Token f la base de données
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return response()->json([
                'message' => 'Le lien de réinitialisation est invalide ou a expiré.'
            ], 400);
        }

        // 3. Nbeddlo l'mot de passe dyal l'User
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. Nms7o l'Token bach mayt3awdch ytkhdem mra khra
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'message' => 'Votre mot de passe a été réinitialisé avec succès.'
        ], 200);
    }
}
