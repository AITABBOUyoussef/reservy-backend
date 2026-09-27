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
    Schema::create('commande_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
        $table->foreignId('produit_id')->constrained()->cascadeOnDelete();

        $table->integer('quantite');
        $table->decimal('prix_unitaire', 8, 2);
        $table->text('instructions_speciales')->nullable(); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('commande_items');
    }
};
