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
        Schema::table('table_restos', function (Blueprint $table) {
                  $table->unique(['etablissement_id', 'numero'], 'unique_table_per_resto');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_restos', function (Blueprint $table) {
               $table->dropUnique('unique_table_per_resto');
       });
    }
};
