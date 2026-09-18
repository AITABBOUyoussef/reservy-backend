<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletCategorieEtablissementRequests extends FormRequest
{
       public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'IdEtablissement'  => ['required', 'integer', 'exists:etablissements,id'],
  'IdCategorie'  => ['required', 'integer', 'exists:categories,id'],
];
}
}
