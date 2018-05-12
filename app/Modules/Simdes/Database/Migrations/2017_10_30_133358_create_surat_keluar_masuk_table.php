<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Core\Helpers\TrackablesMigration;

class CreateSuratKeluarMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->string('no', 20);
            $table->text('isi');
            $table->string('dari')->nullable();
            $table->string('kepada')->nullable();
            $table->date('tanggal');
            $table->string('keterangan');
            $table->unsignedTinyInteger('jenis')->comment('1 surat masuk, 0 surat keluar');

            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            TrackablesMigration::getInstance()->addTrackablesColumn($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_keluar_masuk', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('surat_keluar_masuk');

        Schema::dropIfExists('surat_keluar_masuk');
    }
}
