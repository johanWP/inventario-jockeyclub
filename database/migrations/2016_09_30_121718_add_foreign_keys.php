<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });
        Schema::table('sectors', function ($table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
        Schema::table('areas', function ($table) {
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
        Schema::table('assets', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
        Schema::table('moves', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
        Schema::table('role_user', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('areas', function ($table) {
            $table->dropForeign(['office_id']);
        });

        Schema::table('users', function ($table) {
            $table->dropForeign(['sector_id']);
        });

        Schema::table('sectors', function ($table) {
            $table->dropForeign(['area_id']);
        });

        Schema::table('assets', function ($table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('moves', function ($table) {
            $table->dropForeign(['asset_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('role_user', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
