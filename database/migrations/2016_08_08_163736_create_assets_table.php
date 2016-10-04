<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('prefix', 4);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->date('fechaCompra');
            $table->decimal('precio', 8, 2);
            $table->text('nota');
            $table->string('status',2);  //$status = ['I', 'A', 'X', 'R'];   Nunca asignado, Activo, Dañado, Robado
            $table->integer('type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assets');
        Schema::drop('types');
    }
}
