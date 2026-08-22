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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
        $table->foreignId('table_id')->nullable()->constrained('table_restos')->nullOnDelete(); 

        $table->date('date_reservation');
        $table->time('heure_reservation');
        $table->integer('nombre_personnes');

        $table->decimal('montant_total', 10, 2)->default(0);
        $table->enum('statut_paiement', ['en_attente', 'paye_en_ligne', 'paye_sur_place'])->default('en_attente');
        $table->enum('statut', ['en_attente', 'acceptee', 'refusee', 'terminee'])->default('en_attente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
