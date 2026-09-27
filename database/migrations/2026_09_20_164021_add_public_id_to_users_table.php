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
        Schema::table('users', function (Blueprint $table) {
                      $table->string('public_id')->nullable()->after('avatar');

        });
    }

    /**
     * Reverse the migrations.
     */
// Ex?cute l?op?ration ? down ?.
    public function down(): void
    {
// Traite la logique de la route ou du rappel.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('public_id');
        });
    }
};
