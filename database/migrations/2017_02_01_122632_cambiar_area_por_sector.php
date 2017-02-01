<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiarAreaPorSector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('areas', 'areas_temp');
        Schema::rename('sectors', 'areas');
        Schema::rename('areas_temp', 'sectors');

        Schema::table('sectors', function (Blueprint $table) {
            $table->dropForeign('areas_sector_id_foreign');
            $table->renameColumn('sector_id', 'area_id');
            $table->foreign('area_id')->references('id')->on('areas');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('area_id', 'sector_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('areas', 'areas_temp');
        Schema::rename('sectors', 'areas');
        Schema::rename('areas_temp', 'sectors');

        Schema::table('sectors', function (Blueprint $table) {
            $table->dropForeign('sectors_area_id_foreign');
            $table->renameColumn('area_id', 'sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('sector_id', 'area_id');
        });

    }
}
