<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTablEtablissementRequests extends FormRequest
{
 public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'etablissement_id' => ['required', 'integer', 'exists:etablissements,id'],

            'numero' => [
                'required',
                'integer',
                'max:255'],
  'IdTabl'  => ['required', 'integer', 'exists:table_restos,id'],

            'capacite' => ['required', 'integer'],
        ];
    }
}
