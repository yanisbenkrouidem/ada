<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Agence;

class VehiculesSeeder extends Seeder
{
    public function run()
    {
        // 1. Vérification des agences
        $agenceIds = Agence::pluck('id')->toArray();
        if (empty($agenceIds)) {
            $this->command->info("Aucune agence trouvée !");
            return;
        }

        // 2. Vérification des catégories
        $categories = Category::all();
        if ($categories->count() == 0) {
             $this->command->info("Aucune catégorie trouvée !");
             return;
        }

        // 3. Liste de tes véhicules (Basé sur tes images)
        $flotte = [
            ['img' => '0-sml.png', 'marque' => 'Fiat', 'modele' => '500'],
            ['img' => '1A-sml.png', 'marque' => 'Renault', 'modele' => 'Twingo'],
            ['img' => '2A-sml.png', 'marque' => 'Renault', 'modele' => 'Clio 5'],
            ['img' => '2B-sml.png', 'marque' => 'Peugeot', 'modele' => '208'],
            ['img' => '3A-sml.png', 'marque' => 'Renault', 'modele' => 'Captur'],
            ['img' => '3B-sml.png', 'marque' => 'Peugeot', 'modele' => '2008'],
            ['img' => '4A-sml.png', 'marque' => 'Renault', 'modele' => 'Megane'],
            ['img' => '4B-sml.png', 'marque' => 'Peugeot', 'modele' => '308'],
            ['img' => '5A-sml.png', 'marque' => 'Ford', 'modele' => 'Mondeo'],
            ['img' => '6A-sml.png', 'marque' => 'Mercedes', 'modele' => 'Classe A'],
            ['img' => '6B-sml.png', 'marque' => 'BMW', 'modele' => 'Série 1'],
            ['img' => '6C-sml.png', 'marque' => 'Mercedes', 'modele' => 'Classe C'],
            ['img' => '6D-sml.png', 'marque' => 'BMW', 'modele' => 'X5'],
            ['img' => 'utilitaire.png', 'marque' => 'Renault', 'modele' => 'Trafic'],
            ['img' => 'A-sml.png', 'marque' => 'Mercedes', 'modele' => 'Sprinter'],
            ['img' => 'E-sml.png', 'marque' => 'Iveco', 'modele' => 'Daily Hayon'],
            ['img' => 'deuxroues.png', 'marque' => 'Yamaha', 'modele' => 'X-Max'],
            ['img' => 'sanspermis.png', 'marque' => 'Aixam', 'modele' => 'City'],
            ['img' => 'voiture.png', 'marque' => 'Tesla', 'modele' => 'Model 3'],
        ];

        // 4. Insertion
        foreach ($flotte as $v) {
            
            // On prend une catégorie au hasard
            $categorie = $categories->random();

            DB::table('vehicules')->insert([
                'marque' => $v['marque'],
                'modele' => $v['modele'],
                'immat'  => strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2)) . '-' . rand(100, 999) . '-' . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2)),
                'agence_id' => $agenceIds[array_rand($agenceIds)],
                'categorie_id' => $categorie->id,
                // J'ai enlevé 'created_at' et 'updated_at' car ta table ne les a pas
            ]);
            
            // OPTIONNEL : Si tu veux mettre à jour la photo de la catégorie correspondante
            // DB::table('categories')->where('id', $categorie->id)->update(['photo' => $v['img']]);
        }
    }
}