<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletTablEtablissementRequests extends FormRequest
{
    public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
  'IdTabl'  => ['required', 'integer', 'exists:table_restos,id'],
     'gerant_id'   => ['required', 'integer', 'exists:users,id'],
];
}
}
