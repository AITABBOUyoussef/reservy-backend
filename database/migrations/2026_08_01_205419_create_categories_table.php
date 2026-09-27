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
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
        $table->string('nom'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
