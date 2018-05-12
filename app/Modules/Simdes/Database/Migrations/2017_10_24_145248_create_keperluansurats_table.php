<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//TODO baru sampe sini refactornya

class CreateKeperluansuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keperluan_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->string('nama', 255);
            $table->string('kode_pelayanan', 10);
            $table->string('kode_surat', 10);
            $table->unsignedTinyInteger('tipe')->comment('1 surat pengantar, 2 surat keterangan');
            $table->timestamps();

            $table->foreign('village_id')
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
        Schema::table('keperluan_surat', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });

        Schema::dropIfExists('keperluan_surat');
    }
}
