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
    Schema::create('table_restos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
        $table->integer('numero');
        $table->integer('capacite');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
        Schema::dropIfExists('table_restos');
    }
};
