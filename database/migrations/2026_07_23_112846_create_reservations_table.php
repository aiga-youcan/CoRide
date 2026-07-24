<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trajet_id')->constrained('trajets')->cascadeOnDelete();
            $table->foreignId('passager_id')->constrained('users')->cascadeOnDelete();
            $table->enum('statut', ['en_attente', 'confirmee', 'refusee', 'annulee'])->default('en_attente');
            $table->date('date_reservation');
            // ai_result column is added in a dedicated migration (2026_07_24_103536_add_ai_result_to_reservations_table.php)
            // to ensure the column type is JSON. Do not create it here to avoid duplicate column errors.
            $table->unique(['trajet_id', 'passager_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
