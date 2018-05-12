<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Core\Helpers\TrackablesMigration;

class CreateSuratPelayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pelayanan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->unsignedInteger('keperluan_surat_id');
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('religion_id');
            $table->unsignedInteger('no');
            $table->string('nama', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('alamat', 30);
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->char('nik', 16);
            $table->string('no_kk', 20);
            $table->date('tgl_berlaku_dari');
            $table->date('tgl_berlaku_sampai');
            $table->string('keterangan', 100)
                ->nullable()
                ->comment('keterangan tambahan mengenai surat jika diperlukan');

            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('keperluan_surat_id')
                ->references('id')
                ->on('keperluan_surat')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('job_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('religion_id')
                ->references('id')
                ->on('religion')
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
        Schema::table('surat_pelayanan', function (Blueprint $table) {
            $table->dropForeign(['keperluan_surat_id']);
            $table->dropForeign(['job_id']);
            $table->dropForeign(['village_id']);
            $table->dropForeign(['religion_id']);
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('surat_pelayanan');

        Schema::dropIfExists('surat_pelayanan');
    }
}
