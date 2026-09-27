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
    Schema::create('produit_options', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produit_id')->constrained()->cascadeOnDelete();
        $table->string('nom_option');
        $table->decimal('prix_supplementaire', 8, 2)->default(0); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('produit_options');
    }
};
