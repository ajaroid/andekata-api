<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKematianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_kematian', function (Blueprint $table) {
            // KK Jenazah
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->string('no_surat', 255);
            $table->string('nama_kk', 255);
            $table->string('no_kk', 255);
            // Jenazah
            $table->unsignedInteger('jenazah_id')->nullable();
            $table->char('nik_jenazah', 16);
            $table->string('nama_jenazah', 100);
            $table->enum('jenis_kelamin_jenazah', ['L', 'P']);
            $table->date('tanggal_lahir_jenazah');
            $table->string('tempat_lahir_jenazah', 255);
            $table->integer('agama_jenazah_id')->unsigned();
            $table->integer('pekerjaan_jenazah_id')->unsigned();
            $table->string('alamat_jenazah', 255);
            $table->unsignedBigInteger('kelurahan_jenazah_id')->index();
            $table->tinyInteger('anak_ke')->unsigned();
            $table->dateTime('waktu_kematian');
            $table->string('sebab_kematian', 255);
            $table->string('tempat_kematian', 255);
            $table->enum('menerangkan', ['dokter', 'tenaga_kesehatan', 'kepolisian', 'lainnya']);
            // Ibu jenazah
            $table->unsignedInteger('ibu_id')->nullable();
            $table->char('nik_ibu', 16);
            $table->string('nama_ibu', 100);
            $table->date('tanggal_lahir_ibu');
            $table->string('tempat_lahir_ibu', 255);
            $table->integer('agama_ibu_id')->unsigned();
            $table->integer('pekerjaan_ibu_id')->unsigned();
            $table->string('alamat_ibu', 255);
            $table->unsignedBigInteger('kelurahan_ibu_id')->index();
            // Bapak jenazah
            $table->unsignedInteger('bapak_id')->nullable();
            $table->char('nik_bapak', 16);
            $table->string('nama_bapak', 100);
            $table->date('tanggal_lahir_bapak');
            $table->string('tempat_lahir_bapak', 255);
            $table->integer('agama_bapak_id')->unsigned();
            $table->integer('pekerjaan_bapak_id')->unsigned();
            $table->string('alamat_bapak', 255);
            $table->unsignedBigInteger('kelurahan_bapak_id')->index();
            // Pelapor
            $table->unsignedInteger('pelapor_id')->nullable();
            $table->char('nik_pelapor', 16);
            $table->string('nama_pelapor', 100);
            $table->date('tanggal_lahir_pelapor');
            $table->string('tempat_lahir_pelapor', 255);
            $table->integer('agama_pelapor_id')->unsigned();
            $table->integer('pekerjaan_pelapor_id')->unsigned();
            $table->string('alamat_pelapor', 255);
            $table->unsignedBigInteger('kelurahan_pelapor_id')->index();
            // Saksi 1
            $table->unsignedInteger('saksi1_id')->nullable();
            $table->char('nik_saksi1', 16);
            $table->string('nama_saksi1', 100);
            $table->date('tanggal_lahir_saksi1');
            $table->string('tempat_lahir_saksi1', 255);
            $table->integer('agama_saksi1_id')->unsigned();
            $table->integer('pekerjaan_saksi1_id')->unsigned();
            $table->string('alamat_saksi1', 255);
            $table->unsignedBigInteger('kelurahan_saksi1_id')->index();
            // Saksi 2
            $table->unsignedInteger('saksi2_id')->nullable();
            $table->char('nik_saksi2', 16);
            $table->string('nama_saksi2', 100);
            $table->date('tanggal_lahir_saksi2');
            $table->string('tempat_lahir_saksi2', 255);
            $table->integer('agama_saksi2_id')->unsigned();
            $table->integer('pekerjaan_saksi2_id')->unsigned();
            $table->string('alamat_saksi2', 255);
            $table->unsignedBigInteger('kelurahan_saksi2_id')->index();
            $table->dateTime('waktu_lapor');
            $table->timestamps();

            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK jenazah
            $table->foreign('jenazah_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_jenazah_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_jenazah_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_jenazah_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK Ibu jenazah
            $table->foreign('ibu_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_ibu_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_ibu_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_ibu_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK bapak jenazah
            $table->foreign('bapak_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_bapak_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_bapak_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_bapak_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK pelapor jenazah
            $table->foreign('pelapor_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_pelapor_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_pelapor_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_pelapor_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK saksi1 jenazah
            $table->foreign('saksi1_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_saksi1_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_saksi1_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_saksi1_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK saksi2 jenazah
            $table->foreign('saksi2_id')
                ->references('id')
                ->on('resident')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('agama_saksi2_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('pekerjaan_saksi2_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('kelurahan_saksi2_id')
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
        Schema::table('surat_kematian', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
            $table->dropForeign(['jenazah_id']);
            $table->dropForeign(['agama_jenazah_id']);
            $table->dropForeign(['pekerjaan_jenazah_id']);
            $table->dropForeign(['kelurahan_jenazah_id']);
            $table->dropForeign(['ibu_id']);
            $table->dropForeign(['agama_ibu_id']);
            $table->dropForeign(['pekerjaan_ibu_id']);
            $table->dropForeign(['kelurahan_ibu_id']);
            $table->dropForeign(['bapak_id']);
            $table->dropForeign(['agama_bapak_id']);
            $table->dropForeign(['pekerjaan_bapak_id']);
            $table->dropForeign(['kelurahan_bapak_id']);
            $table->dropForeign(['pelapor_id']);
            $table->dropForeign(['agama_pelapor_id']);
            $table->dropForeign(['pekerjaan_pelapor_id']);
            $table->dropForeign(['kelurahan_pelapor_id']);
            $table->dropForeign(['saksi1_id']);
            $table->dropForeign(['agama_saksi1_id']);
            $table->dropForeign(['pekerjaan_saksi1_id']);
            $table->dropForeign(['kelurahan_saksi1_id']);
            $table->dropForeign(['saksi2_id']);
            $table->dropForeign(['agama_saksi2_id']);
            $table->dropForeign(['pekerjaan_saksi2_id']);
            $table->dropForeign(['kelurahan_saksi2_id']);
        });
        Schema::dropIfExists('surat_kematian');
    }
}
