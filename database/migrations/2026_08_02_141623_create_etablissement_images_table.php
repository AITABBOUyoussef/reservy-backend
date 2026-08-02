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
    Schema::create('etablissement_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
        $table->string('nom_image');
        $table->boolean('est_principale')->default(false); // Tsowira lli ghatban lweela f l'Profil
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissement_images');
    }
};
