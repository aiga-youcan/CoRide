<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/reservations.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('Le fichier reservations.csv est introuvable.');

            return;
        }

        $file = fopen($csvFile, 'r');
        fgetcsv($file); // Ignorer l'en-tête

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            Reservation::create([
                'id' => (int) $row[0],
                'trajet_id' => (int) $row[1],
                'passager_id' => (int) $row[2],
                'statut' => $row[3],
                'date_reservation' => $row[4],
            ]);
        }

        fclose($file);

        $this->command->info('Réservations importées avec succès.');
    }
}
