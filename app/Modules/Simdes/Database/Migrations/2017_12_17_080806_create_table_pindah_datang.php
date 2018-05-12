<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePindahDatang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pindah_datang', function (Blueprint $table) {
            // Asal
            $table->increments('id');
            $table->unsignedBigInteger('kelurahan_id');
            $table->enum('jenis_pindah', ['non-trans', 'trans']);
            $table->enum('klasifikasi_pindah', ['1', '2', '3', '4', '5'])
                ->comment('1 = dalam satu desa/kelurahan, 2 = antar desa/kelurahan, 3 = antar kecamatan, 4 = antar kota/kab, 5 = antar provinsi');
            $table->string('no_kk_asal', 16);
            $table->string('nama_kk_asal', 50);
            $table->string('alamat_asal', 255);
            $table->string('dusun_asal', 20);
            $table->char('rt_asal', 2);
            $table->char('rw_asal', 2);
            $table->unsignedBigInteger('kelurahan_asal_id');
            $table->char('kode_pos_asal', 6);
            $table->string('no_telepon_asal', 16);
            $table->string('nama_pemohon', 50);
            $table->char('nik_pemohon', 16);
            $table->unsignedInteger('pemohon_id');
            // tujuan
            $table->enum('status_kk_tujuan', ['1', '2', '3'])
                ->comment('1 = menumpang kk, 2 = membuat kk baru, 3 = nama kk no kk tetap');
            $table->string('no_kk_tujuan', 16);
            $table->char('nik_kk_tujuan', 16);
            $table->string('nama_kk_tujuan', 50);
            $table->date('tanggal_datang');
            $table->string('alamat_tujuan', 255);
            $table->char('rt_tujuan', 2);
            $table->char('rw_tujuan', 2);
            $table->string('dusun_tujuan', 20);
            $table->unsignedBigInteger('kelurahan_tujuan_id');
            $table->char('kode_pos_tujuan', 6);
            $table->string('no_telepon_tujuan', 16);
            // pindah
            $table->enum('alasan_pindah', ['pekerjaan', 'pendidikan', 'keamanan', 'kesehatan', 'perumahan', 'keluarga', 'lainnya']);
            $table->string('alasan_pindah_lain', 10)->nullable();
            $table->string('alamat_pindah', 255);
            $table->char('rt_pindah', 2);
            $table->char('rw_pindah', 2);
            $table->unsignedBigInteger('kelurahan_pindah_id');
            $table->string('kode_pos_pindah', 255);
            $table->string('no_telepon_pindah', 16);
            $table->enum('jenis_kepindahan', ['1', '2', '3', '4'])
                ->comment('1 = hanya kepala keluarga, 2 = kepala keluarga & seluruh anggota keluarga, 3 = kepala keluarga & sebagian anggota keluarga, 4 = hanya anggota keluarga');
            $table->enum('status_kk_tidak_pindah', ['1', '2', '3', '4', '5'])
                ->comment('1 = menumpang kk, 2 = membuat kk baru, 3 = tidak ada anggota keluarga yg ditinggal, 4 = no kk tetap');
            $table->enum('status_kk_pindah', ['1', '2', '3'])
                ->comment('1 = menumpang kk, 2 = membuat kk baru, 3 = nama kk no kk tetap');
            $table->date('tanggal_pindah');
            $table->date('tanggal_permohonan');
            $table->timestamps();

            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('pemohon_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('kelurahan_asal_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('kelurahan_tujuan_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('kelurahan_pindah_id')
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
        Schema::table('pindah_datang', function (Blueprint $table) {
            $table->dropForeign(['kelurahan_id']);
            $table->dropForeign(['pemohon_id']);
            $table->dropForeign(['kelurahan_asal_id']);
            $table->dropForeign(['kelurahan_tujuan_id']);
            $table->dropForeign(['kelurahan_pindah_id']);
        });
        Schema::dropIfExists('pindah_datang');
    }
}
