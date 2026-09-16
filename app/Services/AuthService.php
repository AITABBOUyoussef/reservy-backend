<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function login(array $data): array
    {
        $user= User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
         throw ValidationException::withMessages([
            'email'=>['Les identifiants fournis sont incorrects.'],
         ]);
        }
        $token = $user->createToken('react-app-token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $token,
            'Role'=>$user->getRoleNames()->first(),
        ];
    }

        public function googleLogin(array $data): array
    {

             $googleUser = Socialite::driver('google')->stateless()->userFromToken($data['token']);

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                ]);
            }

             $token = $user->createToken('reservy_token')->plainTextToken;
        $user->assignRole('client');

             return [
            'message' => 'Connexion réussie avec Google',
            'user'  => $user,
            'token' => $token,
            'Role'=>$user->getRoleNames()->first(),

        ];


    }

    public function inscription(array $data)
{
   $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('client');

            $token = $user->createToken('react-app-token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $token,
            'Role'=>$user->getRoleNames()->first(),

        ];

}
public function forgotPassword(array $data) : array
{
    $token = Str::random(64);
     DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $data['email']],
            ['token' => $token, 'created_at' => now()]
        );
        $resetLink = "http://localhost:5173". "/reset-password?token=" . $token . "&email=" . urlencode($data['email']);
  Mail::send([],[],function ($message) use ($data,$resetLink){
      $message->to($data['email'])
                    ->subject('Réinitialisation de votre mot de passe - Reservy')
                    ->html('
                        <h2>Bonjour,</h2>
                        <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
                        <p>Cliquez sur le lien ci-dessous pour créer un nouveau mot de passe :</p>
                        <a href="' . $resetLink . '" style="display:inline-block;padding:10px 20px;background-color:#b04121;color:white;text-decoration:none;border-radius:5px;">Changer mon mot de passe</a>
                        <p>Si vous n\'avez pas fait cette demande, ignorez cet e-mail.</p>
                    ');
        });
        return [
        'success' => true,
        'message' => 'Le lien de réinitialisation a été envoyé à votre adresse e-mail.'
    ];

  }

public function resetPassword(array $data) : array
{
      $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $data['email'])
            ->where('token', $data['token'])
            ->first();
              if (!$resetRecord) {
            throw new \Exception('Le lien de réinitialisation est invalide ou a expiré.');
        }

          $user = User::where('email',  $data['email'])->first();
        $user->password = Hash::make($data['password']);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $data['email'])->delete();

          return [
            'message' => 'Votre mot de passe a été réinitialisé avec succès.'
        ];
}
    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();

    }

}
