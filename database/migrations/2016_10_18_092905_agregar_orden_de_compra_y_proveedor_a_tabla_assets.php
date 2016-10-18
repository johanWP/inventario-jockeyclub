<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarOrdenDeCompraYProveedorATablaAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function ($table) {
            $table->string('orden_compra', 100)->nullable();
            $table->string('proveedor', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function ($table) {
            $table->dropColumn('orden_compra');
            $table->dropColumn('proveedor');
        });
    }
}
