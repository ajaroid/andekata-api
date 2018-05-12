<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKartuKeluargaDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kk_id');
            $table->unsignedInteger('resident_id');
            $table->unsignedInteger('status_hubungan_keluarga_id');
            $table->timestamps();

            $table->foreign('kk_id')
                ->references('id')
                ->on('kartu_keluarga')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('resident_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('status_hubungan_keluarga_id')
                ->references('id')
                ->on('status_hubungan_keluarga')
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
        Schema::table('kartu_keluarga_detail', function (Blueprint $table) {
            $table->dropForeign(['kk_id']);
            $table->dropForeign(['resident_id']);
            $table->dropForeign(['status_hubungan_keluarga_id']);
        });

        Schema::dropIfExists('kartu_keluarga_detail');
    }
}
