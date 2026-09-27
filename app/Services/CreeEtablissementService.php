<?php

namespace App\Services;

use App\Models\Etablissement;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class CreeEtablissementService
{
    public function CreeEtablissement(array $data)
    {
        $etablissement = Etablissement::create([
            'gerant_id'     => auth()->id(),
            'nom'    => $data['nom'],
            'description'    => $data['description'],
            'adresse'    => $data['adresse'],
            'ville'    => $data['ville'],
            'telephone'    => $data['telephone'],
            'statut'    => 'en_attente',

        ]);
        return [
            'etablissement'  => $etablissement,

        ];
    }
    public function EtablissementAttente()
    {
        $Etablissement_en_attente = DB::table('etablissements')
            ->where('statut', "en_attente")
            ->first();
        return [
            'Etablissement_en_attente'  => $Etablissement_en_attente,
        ];
    }
    public function getAllEtablissement(User $user)
    {
        $Etablissement = Etablissement::with(['images' => function ($query) {
            $query->where('est_principale', 1);
        }])->get();

        return [
            'Etablissement'  => $Etablissement,
        ];
    }
    public function getEtablissementGarant(array $data)
    {


        $etablissement = Etablissement::with([
            'images',
            'tables',
            'categories:id,etablissement_id,nom',
            'produits.categorie:id,nom',
            'produits.produitOptions',
            'produits.produitImages',
            'reviews.client:id,name',
        ])
            ->withAvg('reviews as note_moyenne', 'note')
            ->where('gerant_id', $data['gerant_id'])
            ->get();




        return [
            'etablissements' => $etablissement,
            'msg' => 'Welecom'
        ];
    }
    public function getEtablissement()
    {
        $etablissements = Etablissement::with('images')
            ->withAvg('reviews as note_moyenne', 'note')
            ->whereHas('produits')
            ->where('statut', 'acceptee')
            ->get();

        return [
            'etablissements' => $etablissements,
        ];
    }
    public function getEtablissementDettt(array $data)
    {
        $etablissementId = $data['etablissementId'];

        $etablissements = Etablissement::with(['images', 'tables', 'produits', 'reviews'])->find($etablissementId);
        return [
            'etablissements' => $etablissements,
        ];
    }
    public function getEtablissementDet(array $data)
    {
        $etablissement = Etablissement::with([
            'images',
            'tables',
            'produits.categorie',
            'produits.produitOptions',
            'produits.produitImages',
            'reviews.client:id,name'
        ])
            ->withAvg('reviews as note_moyenne', 'note')
            ->findOrFail($data['etablissementId']);

        return [
            'etablissements' => $etablissement
        ];
    }


    public function AcceptEtablissement(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $IDAdmin = auth()->id();
        $admin = User::findOrFail($IDAdmin);
        $user = User::findOrFail($data['gerant_id']);
        $etablissement->update([
            'statut' => $data['statut'],
        ]);
        if ($data['statut'] === 'acceptee') {
            $role = $admin->getRoleNames()->first();
            if ($role === "admin") {
                $user->removeRole('client');
                $user->assignRole('gerant');
            }
        }
        return [
            'etablissement'  => $etablissement,
            'user' => $user,
        ];
    }
    public function EditEtablissement(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $user = auth()->user();
        $estProprietaire = $etablissement->gerant_id === $user->id;

        if (! $user->hasRole('admin') && ! $estProprietaire) {
            throw new AuthorizationException(
                'Vous ne pouvez pas modifier cet établissement.'
            );
        }

        if ($user->hasRole('admin') || $estProprietaire) {
            $etablissement->update([

                'nom'    => $data['nom'],
                'description'    => $data['description'],
                'adresse'    => $data['adresse'],
                'ville'    => $data['ville'],
                'telephone'    => $data['telephone'],


            ]);
        }
        return [
            'etablissement'  => $etablissement,

        ];
    }

    public function destroy(array $data)
    {
        $etablissement = Etablissement::findOrFail($data['IdEtablissement']);
        $user = auth()->user();

        if (! $user->hasRole('admin') && $etablissement->gerant_id !== $user->id) {
            throw new AuthorizationException(
                'Vous ne pouvez pas supprimer cet établissement.'
            );
        }

        $etablissement->delete();
    }
}
