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
        Schema::table('etablissement_images', function (Blueprint $table) {
            $table->string('public_id')->nullable()->after('nom_image');
        });
    }

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
// Traite la logique de la route ou du rappel.
        Schema::table('etablissement_images', function (Blueprint $table) {
            $table->dropColumn('public_id');
        });
    }
};
