<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermohonanKk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('permohonan_kk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kelurahan_id');
            $table->unsignedInteger('resident_id')->nullable();
            $table->string('nama', 50);
            $table->char('nik', 16);
            $table->char('no_kk_lama', 16);
            $table->string('alamat', 255);
            $table->char('rt', 2);
            $table->char('rw', 2);
            $table->unsignedBigInteger('kelurahan_pemohon_id');
            $table->char('kode_pos', 5);
            $table->string('no_telepon', 16);
            $table->enum('alasan', ['1', '2', '3'])->comment('1 = karena membentuk rumah tangga baru, 2 = karena kk hilang/rusak, 3 = lainnya');
            $table->unsignedTinyInteger('jumlah_anggota_keluarga');
            $table->timestamps();

            $table->foreign('resident_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('kelurahan_pemohon_id')
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

        Schema::table('permohonan_kk', function (Blueprint $table) {
            $table->dropForeign(['resident_id']);
            $table->dropForeign(['kelurahan_id']);
            $table->dropForeign(['kelurahan_pemohon_id']);
        });

        Schema::dropIfExists('permohonan_kk');
    }
}
