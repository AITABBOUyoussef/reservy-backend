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
    Schema::create('etablissements', function (Blueprint $table) {
        $table->id();
        // L'Gérant li m-creyi l'resto
        $table->foreignId('gerant_id')->constrained('users')->cascadeOnDelete();
        $table->string('nom');
        $table->text('description')->nullable();
        $table->string('adresse');
        $table->string('ville');
        $table->string('telephone');
        // L'Admin khasso y-valider l'resto 9bel mayban l'klyan
        $table->boolean('est_valide')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
