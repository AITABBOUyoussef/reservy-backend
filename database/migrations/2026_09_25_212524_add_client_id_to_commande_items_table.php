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
        Schema::table('commande_items', function (Blueprint $table) {
         $table->foreignId('client_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
// Traite la logique de la route ou du rappel.
        Schema::table('commande_items', function (Blueprint $table) {
             $table->dropColumn('client_id');
        });
    }
};
