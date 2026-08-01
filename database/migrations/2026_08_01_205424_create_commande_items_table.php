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
    Schema::create('commande_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
        $table->foreignId('produit_id')->constrained()->cascadeOnDelete();

        $table->integer('quantite');
        $table->decimal('prix_unitaire', 8, 2); // Kan-sauvegarderw l'prix hnaya bach ila tbeddel f l'menu, l'historique dyal l'client maydi3ch
        $table->text('instructions_speciales')->nullable(); // Hnaya fin kiktb l'client "Bla besla 3afak"

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_items');
    }
};
