<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePindahDatangDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pindah_datang_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pindah_datang_id');
            $table->unsignedInteger('resident_id');
            $table->char('nik', 16);
            $table->string('nama', 50);
            $table->unsignedInteger('status_hub_keluarga_id');
            $table->timestamps();

            $table->foreign('resident_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('pindah_datang_id')
                ->references('id')
                ->on('pindah_datang')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('status_hub_keluarga_id')
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
        Schema::table('pindah_datang_detail', function (Blueprint $table) {
            $table->dropForeign(['resident_id']);
            $table->dropForeign(['pindah_datang_id']);
            $table->dropForeign(['status_hub_keluarga_id']);
        });
        Schema::dropIfExists('pindah_datang_detail');
    }
}
