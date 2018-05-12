<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermohonanKkDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('permohonan_kk_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permohonan_kk_id');
            $table->unsignedInteger('resident_id')->nullable();
            $table->char('nik', 16);
            $table->string('nama', 50);
            $table->unsignedInteger('status_hub_keluarga_id');
            $table->timestamps();

            $table->foreign('resident_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('permohonan_kk_id')
                ->references('id')
                ->on('permohonan_kk')
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
        Schema::table('permohonan_kk_detail', function (Blueprint $table) {
            $table->dropForeign(['resident_id']);
            $table->dropForeign(['permohonan_kk_id']);
            $table->dropForeign(['status_hub_keluarga_id']);
        });
        Schema::dropIfExists('permohonan_kk_detail');
    }
}
