<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        // Créer le nouvel admin
        User::create([
            'name' => 'Admin Skincare',
            'email' => 'admin@skincare.com',
            'password' => Hash::make('Admin1234!'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        $this->command->info('✅ Admin créé avec succès!');
        $this->command->info('📧 Email: admin@skincare.com');
        $this->command->info('🔑 Mot de passe: Admin1234!');
    }
}