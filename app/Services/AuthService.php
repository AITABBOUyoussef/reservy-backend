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
}
