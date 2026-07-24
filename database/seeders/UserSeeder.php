<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('data/employes.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('Le fichier employes.csv est introuvable.');

            return;
        }

        $file = fopen($csvFile, 'r');

        // Ignorer l'en-tête
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            User::create([
                'id' => (int) $row[0],
                'name' => $row[1],
                'email' => $row[2],
                'password' => Hash::make('password'),
                'entreprise' => $row[3],
                'ville_residence' => $row[4],
                'role' => str_replace(' ', '_', strtolower($row[5])),
            ]);
        }

        fclose($file);

        $this->command->info('Employés importés avec succès.');
    }
}
