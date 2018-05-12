<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ktp', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->unsignedInteger('resident_id');
            $table->string('nama', 50);
            $table->string('no_kk', 20);
            $table->char('nik', 16);
            $table->string('alamat', 100);
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->char('kode_pos', 5);
            $table->enum('jenis', ['baru', 'ganti']);
            $table->timestamps();

            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('resident_id')
                ->references('id')
                ->on('resident')
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
        Schema::table('ktp', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
            $table->dropForeign(['resident_id']);

        });
        Schema::dropIfExists('ktp');
    }
}
