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
    public function down(): void
    {
        Schema::dropIfExists('produit_options');
    }
};
