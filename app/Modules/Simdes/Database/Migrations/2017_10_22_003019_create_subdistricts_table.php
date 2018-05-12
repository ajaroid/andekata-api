<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('regency_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('regency_id')
                ->references('id')
                ->on('regency')
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
        Schema::table('subdistrict', function (Blueprint $table) {
            $table->dropForeign(['regency_id']);
        });
        Schema::dropIfExists('subdistrict');
    }
}
