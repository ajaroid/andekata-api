<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKelahiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_kelahiran', function (Blueprint $table) {
            // Bayi
            $table->increments('id');
            $table->unsignedBigInteger('kelurahan_id');
            $table->string('nama_kk', '50');
            $table->char('no_kk', '16');
            $table->string('nama', '50');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('tempat_dilahirkan', ['1', '2', '3', '4', '5'])->comment('1 = RS/RB, 2 = Puskesmas, 3 = Polindes, 4 = Rumah, 5 = lainnya');
            $table->string('tempat_kelahiran', 100);
            $table->dateTime('waktu_kelahiran');
            $table->enum('jenis_kelahiran', ['1', '2', '3', '4', '5'])->comment('1 = tunggal, 2 = kembar 2, 3 = kembar 3, 4 = kembar 4, 5 = lainnya');
            $table->unsignedTinyInteger('kelahiran_ke');
            $table->enum('penolong_kelahiran', ['1', '2', '3', '4'])->comment('1 = dokter, 2 = bidan/perawat 2, 3 = dukun 3, 4 = lainnya');
            $table->unsignedDecimal('berat', 3, 2);
            $table->unsignedDecimal('panjang', 4, 1);
            // Ibu bayi
            $table->unsignedInteger('ibu_id')->nullable();
            $table->char('nik_ibu', 16);
            $table->string('nama_ibu', 100);
            $table->date('tanggal_lahir_ibu');
            $table->string('tempat_lahir_ibu', 255);
            $table->integer('agama_ibu_id')->unsigned();
            $table->integer('pekerjaan_ibu_id')->unsigned();
            $table->string('alamat_ibu', 255);
            $table->unsignedBigInteger('kelurahan_ibu_id')->index();
            // Bapak bayi
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

            $table->foreign('kelurahan_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            // FK Ibu bayi
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
            // FK bapak bayi
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
            // FK pelapor bayi
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
            // FK saksi1 bayi
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
            // FK saksi2 bayi
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
        Schema::table('surat_kelahiran', function (Blueprint $table) {
            $table->dropForeign(['kelurahan_id']);
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
        Schema::dropIfExists('surat_kelahiran');
    }
}
