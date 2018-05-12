<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableF101 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('biodata_penduduk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kelurahan_id');
            $table->string('nama_kk', 50);
            $table->string('alamat', 255);
            $table->string('dusun', 20);
            $table->char('rt', 2);
            $table->char('rw', 2);
            $table->unsignedBigInteger('kelurahan_pemohon_id');
            $table->string('ketua_rt', 50);
            $table->string('ketua_rw', 50);
            $table->char('kode_pos', 5);
            $table->unsignedTinyInteger('jumlah_anggota');
            $table->string('no_telepon', 16);
            $table->unsignedInteger('user_id');
            $table->date('tanggal');
            $table->timestamps();

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

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('biodata_penduduk', function (Blueprint $table) {
            $table->dropForeign(['kelurahan_id']);
            $table->dropForeign(['kelurahan_pemohon_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('biodata_penduduk');
    }
}
