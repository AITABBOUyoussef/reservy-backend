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
        $table->foreignId('gerant_id')->constrained('users')->cascadeOnDelete();
        $table->string('nom');
        $table->text('description')->nullable();
        $table->string('adresse');
        $table->string('ville');
        $table->string('telephone');
        $table->enum('statut', ['en_attente', 'acceptee', 'refusee'])->default('en_attente');
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
