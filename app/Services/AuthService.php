<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        ];
    }

    public function inscription(array $data)
{
   $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
            $token = $user->createToken('react-app-token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $token,
        ];

}
    public function editProfil(array $data)
    {
          $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
            $token = $user->createToken('react-app-token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();

    }
      public function destroy(User $user)
    {
        $user->delete();

    }
}
