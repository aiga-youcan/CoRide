<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/employes.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('Le fichier employes.csv est introuvable.');

            return;
        }

        $file = fopen($csvFile, 'r');
        fgetcsv($file); // Skip header

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            if (! empty($row[3])) {
                Entreprise::firstOrCreate([
                    'nom' => trim($row[3]),
                ]);
            }
        }

        fclose($file);

        $this->command->info('Entreprises importées avec succès.');
    }
}
