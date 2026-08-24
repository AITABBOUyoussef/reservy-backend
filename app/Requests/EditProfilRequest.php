<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilRequest extends FormRequest
{
public function authorize(): bool
{
  return true;

}
public function rules(): array
{
    return [
        // Name w Email غالبا katsifthom mn l'frontend (wakha ikon fihom l'valeur l9dima), y3ni 'required' mzyana lihom.
        'name'  => ['nullable', 'string'],
        'email' => [ 'nullable','email'],

        // Avatar w Phone msmou7 ykono khawyin
        'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'phone'  => ['nullable', 'string'],

        // Passwords (facultatifs)
        // 'required_with:password' = Ila 3mer password, darouri y3mer old_password
        'old_password'          => ['nullable', 'required_with:password', 'string'],
        'password'              => ['nullable', 'string', 'confirmed'],
        'password_confirmation' => ['nullable', 'string'],

        'logout_other_devices'  => ['nullable', 'boolean'],
    ];
}
public function messages(): array
{
    return [
        // Name
        'name.required' => 'Le nom complet est obligatoire.',

        // Email
        'email.required' => 'L\'adresse e-mail est obligatoire.',
        'email.email'    => 'Veuillez saisir une adresse e-mail valide.',

        // Avatar
        'avatar.image'   => 'Le fichier fourni doit être une image.',
        'avatar.mimes'   => 'L\'avatar doit être un fichier de type : jpeg, png, jpg ou gif.',
        'avatar.max'     => 'La taille de l\'avatar ne doit pas dépasser 2 Mo (2048 Ko).',

        // Phone
        'phone.required' => 'Le numéro de téléphone est obligatoire.',
        'phone.string'   => 'Le format du numéro de téléphone n\'est pas valide.',

        // Old Password
        'old_password.required' => 'Veuillez saisir votre ancien mot de passe.',
        'old_password.string'   => 'Le format de l\'ancien mot de passe n\'est pas valide.',
        'old_password.required_with' => 'Vous devez saisir l\'ancien mot de passe pour le modifier.',

        // New Password
        'password.required' => 'Le nouveau mot de passe est obligatoire.',
        'password.string'   => 'Le format du nouveau mot de passe n\'est pas valide.',

        // Password Confirmation
        'password_confirmation.required' => 'Veuillez confirmer votre nouveau mot de passe.',
        'password_confirmation.string'   => 'Le format de la confirmation n\'est pas valide.',

        // Logout other devices
        'logout_other_devices.boolean' => 'Le choix de déconnexion des autres appareils n\'est pas valide.',
    ];
}
}
