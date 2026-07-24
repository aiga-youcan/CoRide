<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/villes.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('Le fichier villes.csv est introuvable.');

            return;
        }

        $file = fopen($csvFile, 'r');

        // Ignorer l'en-tête
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {

            Ville::create([
                'nom' => $row[0],
            ]);

        }

        fclose($file);

        $this->command->info('Villes importées avec succès.');
    }
}
