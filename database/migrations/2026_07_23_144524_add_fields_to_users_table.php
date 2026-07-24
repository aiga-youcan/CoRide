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
        Schema::table('users', function (Blueprint $table) {

            $table->string('entreprise')->nullable()->after('email');

            $table->enum('role', [
                'conducteur',
                'passager',
                'les_deux',
            ])->default('passager')->after('entreprise');

            $table->string('ville_residence')->nullable()->after('role');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'entreprise',
                'role',
                'ville_residence',
            ]);
        });
    }
};
