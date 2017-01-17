<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaCamposDeDetalleAAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('sistema_operativo', 100);
            $table->string('disco_duro', 100);
            $table->string('procesador', 100);
            $table->string('motherboard', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('sistema_operativo');
            $table->dropColumn('disco_duro');
            $table->dropColumn('procesador');
            $table->dropColumn('motherboard');
        });
    }
}
