<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Etablissement;
use App\Models\EtablissementImage;
use App\Models\Produit;
use App\Models\ProduitImage;
use App\Models\ProduitOption;
use App\Models\TableResto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Cree les donnees de demonstration de la plateforme.
     */
    public function run(): void
    {
 

        $client = User::updateOrCreate(
            ['email' => 'demo.client@reservy.test'],
            ['name' => 'Client Demo', 'password' => Hash::make('Demo1234!')]
        );
        $client->syncRoles(['client']);

        $restaurants = [
            ['Le Jardin Secret', 'Cuisine marocaine moderne', 'Marrakech', 'Rue de la Kasbah'],
            ['Casa Mediterranea', 'Saveurs mediterraneennes et poissons frais', 'Agadir', 'Boulevard du Littoral'],
            ['La Terrasse Blanche', 'Cuisine internationale avec vue panoramique', 'Casablanca', 'Corniche Ain Diab'],
            ['Riad Safran', 'Specialites traditionnelles et patisseries maison', 'Fes', 'Rue Talaa Kebira'],
            ['Ocean Table', 'Grillades, fruits de mer et cuisine du marche', 'Tanger', 'Avenue Mohammed VI'],
            ['Atlas Lounge', 'Cuisine fusion et ambiance lounge', 'Rabat', 'Avenue Fal Ould Oumeir'],
            ['Dar Zellij', 'Cuisine familiale dans un cadre authentique', 'Meknes', 'Place Lahdim'],
            ['Le Patio Vert', 'Brunch, salades et plats faits maison', 'Oujda', 'Boulevard Mohammed V'],
        ];

        $categoryNames = ['Entrees', 'Plats principaux', 'Desserts'];
        $products = [
            ['Salade maison', 'Salade fraiche aux legumes de saison', 42],
            ['Tajine signature', 'Tajine prepare avec des produits locaux', 78],
            ['Burger du chef', 'Pain artisanal, viande grillee et sauce maison', 68],
            ['Pates aux legumes', 'Pates fraiches et legumes grilles', 59],
            ['Poisson grille', 'Poisson du jour servi avec accompagnement', 95],
            ['Pastilla traditionnelle', 'Recette maison aux amandes et cannelle', 72],
            ['Cheesecake maison', 'Dessert cremeux aux fruits rouges', 38],
            ['The a la menthe', 'The vert, menthe fraiche et eau de fleur', 22],
            ['Jus de saison', 'Jus presse a froid selon les fruits disponibles', 28],
        ];

        foreach ($restaurants as $index => [$name, $description, $city, $address]) {
            $gerant = User::updateOrCreate(
                ['email' => 'demo.gerant' . ($index + 1) . '@reservy.test'],
                [
                    'name' => 'Gerant ' . ($index + 1),
                    'password' => Hash::make('Demo1234!'),
                ]
            );
            $gerant->syncRoles(['gerant']);

            $restaurant = Etablissement::updateOrCreate(
                ['nom' => $name],
                [
                    'gerant_id' => $gerant->id,
                    'description' => $description,
                    'adresse' => $address,
                    'ville' => $city,
                    'telephone' => '+212 600 000 ' . str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                    'statut' => 'acceptee',
                ]
            );

            for ($tableNumber = 1; $tableNumber <= 8; $tableNumber++) {
                TableResto::updateOrCreate(
                    ['etablissement_id' => $restaurant->id, 'numero' => $tableNumber],
                    ['capacite' => 2 + (($tableNumber + $index) % 5)]
                );
            }

            foreach ($categoryNames as $categoryName) {
                $category = Categorie::updateOrCreate(
                    ['etablissement_id' => $restaurant->id, 'nom' => $categoryName],
                    []
                );

                foreach ($products as $productIndex => [$productName, $productDescription, $price]) {
                    if ($productIndex % count($categoryNames) !== array_search($categoryName, $categoryNames, true)) {
                        continue;
                    }

                    $product = Produit::updateOrCreate(
                        ['etablissement_id' => $restaurant->id, 'nom' => $productName],
                        [
                            'categorie_id' => $category->id,
                            'description' => $productDescription,
                            'prix' => $price + ($index * 2),
                        ]
                    );

                    ProduitOption::updateOrCreate(
                        ['produit_id' => $product->id, 'nom_option' => 'Portion supplementaire'],
                        ['prix_supplementaire' => 10]
                    );

                    ProduitImage::updateOrCreate(
                        ['produit_id' => $product->id, 'est_principale' => true],
                        ['nom_image' => $this->imageUrl('food-' . (($productIndex % 6) + 1))]
                    );
                }
            }

            foreach (range(1, 4) as $imageIndex) {
                EtablissementImage::updateOrCreate(
                    ['etablissement_id' => $restaurant->id, 'est_principale' => $imageIndex === 1],
                    ['nom_image' => $this->imageUrl('restaurant-' . (($index % 8) + 1) . '-' . $imageIndex)]
                );
            }
        }
    }

    /**
     * Retourne une image distante utilisable sans stockage local.
     */
    private function imageUrl(string $seed): string
    {
        $images = [
            'restaurant-1-1' => '1517248135467-4c7edcad34c4',
            'restaurant-1-2' => '1552566626-52f8b828add9',
            'restaurant-1-3' => '1515003197210-e0cd71810b5f',
            'restaurant-1-4' => '1414235077428-338989a2e8c0',
            'restaurant-2-1' => '1547592180-85f173990554',
            'restaurant-2-2' => '1559339352-11d035aa65de',
            'restaurant-2-3' => '1544025162-d76694265947',
            'restaurant-2-4' => '1504674900247-0877df9cc836',
            'restaurant-3-1' => '1517248135467-4c7edcad34c4',
            'restaurant-3-2' => '1559339352-11d035aa65de',
            'restaurant-3-3' => '1504674900247-0877df9cc836',
            'restaurant-3-4' => '1547592180-85f173990554',
            'restaurant-4-1' => '1414235077428-338989a2e8c0',
            'restaurant-4-2' => '1515003197210-e0cd71810b5f',
            'restaurant-4-3' => '1544025162-d76694265947',
            'restaurant-4-4' => '1552566626-52f8b828add9',
        ];

        $foodImages = [
            'food-1' => '1546069901-ba9599a7e63c',
            'food-2' => '1565299624946-b28f40a0ae38',
            'food-3' => '1550547660-d9450f859349',
            'food-4' => '1473093295043-cdd812d0e601',
            'food-5' => '1540189549336-e6e99c3679fe',
            'food-6' => '1559339352-11d035aa65de',
        ];

        return 'https://images.unsplash.com/photo-' . ($images[$seed] ?? $foodImages[$seed] ?? '1517248135467-4c7edcad34c4');
    }
}
