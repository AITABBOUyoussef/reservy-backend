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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
        $table->integer('note'); 
        $table->text('commentaire')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
