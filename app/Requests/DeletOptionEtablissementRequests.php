<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletOptionEtablissementRequests extends FormRequest
{
       public function authorize():bool
    {
    return true;
    }
 public function rules(): array
{
return [
  'produit_id'  => ['required', 'integer', 'exists:produits,id'],
  'option_id'  => ['required', 'integer', 'exists:produit_options,id'],
];
}
}
