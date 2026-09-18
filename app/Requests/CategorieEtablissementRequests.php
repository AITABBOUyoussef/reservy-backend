<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategorieEtablissementRequests extends FormRequest
{
      public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'etablissement_id'  => ['required', 'integer', 'exists:etablissements,id'],
        'nom'         => ['required', 'string', 'max:255',
        Rule::unique('categories')->where(function ($query) {
                    return $query->where('etablissement_id', $this->etablissement_id);
                })
]];

}
}
