<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyEtablissementRequests extends FormRequest
{
    public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
     'gerant_id'   => ['required', 'integer', 'exists:users,id'],
];
}
}
