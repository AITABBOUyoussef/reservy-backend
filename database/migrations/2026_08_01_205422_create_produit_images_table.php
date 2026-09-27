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
    Schema::create('produit_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produit_id')->constrained()->cascadeOnDelete();
        $table->string('nom_image');
        $table->boolean('est_principale')->default(false); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('produit_images');
    }
};
