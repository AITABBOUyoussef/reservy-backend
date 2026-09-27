<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Ex?cute l?op?ration ? up ?.
    public function up(): void
    {
// Traite la logique de la route ou du rappel.
        Schema::table('table_restos', function (Blueprint $table) {
                  $table->unique(['etablissement_id', 'numero'], 'unique_table_per_resto');

        });
    }

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
// Traite la logique de la route ou du rappel.
        Schema::table('table_restos', function (Blueprint $table) {
               $table->dropUnique('unique_table_per_resto');
       });
    }
};
