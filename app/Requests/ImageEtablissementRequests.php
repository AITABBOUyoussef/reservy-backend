<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageEtablissementRequests extends FormRequest
{
  public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
    return [

        'etablissement_id'  => ['required', 'integer', 'exists:etablissements,id'],
        'est_principale'     => ['required', 'boolean', 'max:255'],
        'nom_image' =>  ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    ];
}

public function messages(): array
{
    return [

    ];
}
}
