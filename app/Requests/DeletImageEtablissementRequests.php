<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletImageEtablissementRequests extends FormRequest
{
    public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
  'IdImage'  => ['required', 'integer', 'exists:etablissement_images,id'],
     'gerant_id'   => ['required', 'integer', 'exists:users,id'],
];
}
}
