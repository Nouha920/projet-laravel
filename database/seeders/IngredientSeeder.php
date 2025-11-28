<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les contraintes de clé étrangère temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Vider les tables
        DB::table('ingredient_categorie')->truncate();
        DB::table('categorie_ingredients')->truncate();
        DB::table('ingredients')->truncate();
        
        // Réactiver les contraintes
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Création des catégories
        $categories = [
            ['id' => 1, 'nom' => 'Hydratant', 'slug' => 'hydratant', 'couleur' => 'blue', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Antioxydant', 'slug' => 'antioxydant', 'couleur' => 'green', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Exfoliant', 'slug' => 'exfoliant', 'couleur' => 'purple', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nom' => 'Apaisant', 'slug' => 'apaisant', 'couleur' => 'pink', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nom' => 'Anti-âge', 'slug' => 'anti-age', 'couleur' => 'orange', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nom' => 'Régulateur', 'slug' => 'regulateur', 'couleur' => 'yellow', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categorie_ingredients')->insert($categories);

        // Création des ingrédients
        $ingredients = [
            [
                'nom' => 'Acide Hyaluronique',
                'slug' => 'acide-hyaluronique',
                'emoji' => '💧',
                'description' => 'Hydratant puissant capable de retenir jusqu\'à 1000 fois son poids en eau pour une peau repulpée et hydratée.',
                'note' => 4.8,
                'efficacite' => 5,
                'naturel' => true,
                'benefices' => json_encode(['Hydratation intense', 'Repulpe la peau', 'Atténue les ridules']),
                'types_peau' => json_encode(['sèche', 'mixte', 'mature']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Niacinamide',
                'slug' => 'niacinamide', 
                'emoji' => '🎭',
                'description' => 'Multifonction, régule le sébum, réduit les pores et unifie le teint. Le couteau suisse du skincare.',
                'note' => 4.7,
                'efficacite' => 5,
                'naturel' => false,
                'benefices' => json_encode(['Régule le sébum', 'Réduit les pores', 'Unifie le teint']),
                'types_peau' => json_encode(['grasse', 'mixte', 'sensible']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Vitamine C',
                'slug' => 'vitamine-c',
                'emoji' => '🍊',
                'description' => 'Antioxydant puissant qui protège la peau des radicaux libres et stimule la production de collagène.',
                'note' => 4.5,
                'efficacite' => 4,
                'naturel' => true,
                'benefices' => json_encode(['Protection antioxydante', 'Éclat du teint', 'Stimule le collagène']),
                'types_peau' => json_encode(['normale', 'mixte', 'mature']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Rétinol',
                'slug' => 'retinol',
                'emoji' => '🌟',
                'description' => 'Gold standard anti-âge, stimule le renouvellement cellulaire et la production de collagène.',
                'note' => 4.9,
                'efficacite' => 5,
                'naturel' => false,
                'benefices' => json_encode(['Réduction des rides', 'Renouvellement cellulaire', 'Texture améliorée']),
                'types_peau' => json_encode(['mature', 'normale']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Acide Salicylique',
                'slug' => 'acide-salicylique',
                'emoji' => '🌀',
                'description' => 'Exfoliant BHA qui pénètre dans les pores pour les désincruster et réduire les imperfections.',
                'note' => 4.3,
                'efficacite' => 4,
                'naturel' => false,
                'benefices' => json_encode(['Désincruste les pores', 'Réduit les boutons', 'Exfolie en profondeur']),
                'types_peau' => json_encode(['grasse', 'acnéique', 'mixte']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Aloe Vera',
                'slug' => 'aloe-vera',
                'emoji' => '🌿',
                'description' => 'Apaisant naturel, hydrate et calme les irritations. Idéal pour les peaux sensibles.',
                'note' => 4.2,
                'efficacite' => 3,
                'naturel' => true,
                'benefices' => json_encode(['Apaisant immédiat', 'Hydratation légère', 'Calme les rougeurs']),
                'types_peau' => json_encode(['sensible', 'sèche', 'grasse']),
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('ingredients')->insert($ingredients);

        // Table de liaison ingrédients-catégories
        $ingredientCategories = [
            // Acide Hyaluronique → Hydratant, Anti-âge
            ['ingredient_id' => 1, 'categorie_ingredient_id' => 1],
            ['ingredient_id' => 1, 'categorie_ingredient_id' => 5],
            // Niacinamide → Régulateur
            ['ingredient_id' => 2, 'categorie_ingredient_id' => 6],
            // Vitamine C → Antioxydant, Anti-âge
            ['ingredient_id' => 3, 'categorie_ingredient_id' => 2],
            ['ingredient_id' => 3, 'categorie_ingredient_id' => 5],
            // Rétinol → Anti-âge
            ['ingredient_id' => 4, 'categorie_ingredient_id' => 5],
            // Acide Salicylique → Exfoliant, Régulateur
            ['ingredient_id' => 5, 'categorie_ingredient_id' => 3],
            ['ingredient_id' => 5, 'categorie_ingredient_id' => 6],
            // Aloe Vera → Apaisant
            ['ingredient_id' => 6, 'categorie_ingredient_id' => 4],
        ];

        DB::table('ingredient_categorie')->insert($ingredientCategories);

        $this->command->info('✅ 6 ingrédients et 6 catégories créés avec succès !');
    }
}