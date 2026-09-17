<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class TablEtablissementRequests extends FormRequest
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
                'max:255',
               Rule::unique('table_restos')->where(function ($query) {
                    return $query->where('etablissement_id', $this->etablissement_id);
                })
            ],

            'capacite' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
           'numero.unique' => 'Had ra9m dyal la table deja kayn f had l\'établissement.',

           'numero.required' => 'Ra9m dyal la table darori.',
            'capacite.required' => 'Capacité dyal la table daroriya.',
        ];
    }
}
