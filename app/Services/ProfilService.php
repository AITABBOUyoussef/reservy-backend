<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class ProfilService
{
    /**
     * Create a new class instance.
     */
     public function editProfil(User $user, array $data)
    {
           if (isset($data['avatar'])) {
    $avatar = $data['avatar'];
    $fileName = time() . '.' . $avatar->extension();

    // Nsauvegardew tswira f dossier public/photos
    $avatar->move(public_path('photos'), $fileName);

    // N'affectew smit tswira jdida l'user
    $user->avatar = $fileName;
}

          $user->fill([
         'name'  => $data['name'] ?? $user->name,
    'email' => $data['email'] ?? $user->email,
    'phone' => $data['phone'] ?? $user->phone,
        ]);
if (!empty($data['password'])) {

        if (empty($data['old_password']) || !Hash::check($data['old_password'], $user->getOriginal('password'))) {
            throw ValidationException::withMessages([
                'old_password' => ['Le mot de passe actuel est incorrect.'],
            ]);
        }
      $user->password = Hash::make($data['password']);
    }

$user->save();
if (!empty($data['logout_other_devices'])) {
        $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();
    }
        return [
            'user'  => $user,

        ];
    }

         public function destroy(User $user)
    {
        $user->delete();

    }
}
