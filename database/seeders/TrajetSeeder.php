<?php

namespace Database\Seeders;

use App\Models\Trajet;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/trajets.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('Le fichier trajets.csv est introuvable.');

            return;
        }

        $file = fopen($csvFile, 'r');
        fgetcsv($file); // Ignorer l'en-tête

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            Trajet::create([
                'id' => (int) $row[0],
                'conducteur_id' => (int) $row[1],
                'ville_depart' => $row[2],
                'ville_arrivee' => $row[3],
                'horaire' => $row[4],
                'places_disponibles' => (int) $row[5],
                'jours_recurrence' => $row[6],
            ]);
        }

        fclose($file);

        $this->command->info('Trajets importés avec succès.');
    }
}
