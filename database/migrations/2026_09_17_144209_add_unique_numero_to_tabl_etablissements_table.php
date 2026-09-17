<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tabl_etablissements', function (Blueprint $table) {
            // Hna kanggolih: etablissement_id m3a numero khashom ikono unique mchroukin
            $table->unique(['etablissement_id', 'numero'], 'unique_table_per_resto');
        });
    }

    public function down()
    {
        Schema::table('tabl_etablissements', function (Blueprint $table) {
            // bach ila drti rollback itms7
            $table->dropUnique('unique_table_per_resto');
        });
    }
};
