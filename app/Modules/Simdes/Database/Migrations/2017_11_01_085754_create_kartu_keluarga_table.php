<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKartuKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id')->index();
            $table->string('no_kk', 16)->unique();
            $table->string('nama', 100);
            $table->string('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->char('kode_pos', 6);
            $table->string('status_ekonomi')->nullable();
            $table->tinyInteger('status')->comment('0 = inactive, 1 = active');
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
        Schema::table('kartu_keluarga', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });

        Schema::dropIfExists('kartu_keluarga');
    }
}
