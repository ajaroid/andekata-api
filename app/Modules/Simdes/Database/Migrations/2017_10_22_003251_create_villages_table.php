<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->integer('subdistrict_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('subdistrict_id')
                ->references('id')
                ->on('subdistrict')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });


        Schema::table('users', function (Blueprint $table) {
            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('village', function (Blueprint $table) {
            $table->dropForeign(['subdistrict_id']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });


        Schema::dropIfExists('village');
    }
}
