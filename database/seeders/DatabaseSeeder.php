<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
       // Créer un utilisateur admin
User::create([
    'name' => 'Admin Skincare',
    'email' => 'admin@skincare.com',
    'password' => bcrypt('password'),
    'role' => 'admin',  // ← Utilisez 'admin' au lieu de 'user'
]);
    }
}
