<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Core\Helpers\TrackablesMigration;

class SuratNikah extends Migration
{
    const DATA_PEMOHON  = 'pemohon';
    const DATA_CATIN    = 'catin';
    const DATA_AYAH     = 'ayah';
    const DATA_IBU      = 'ibu';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_nikah', function (Blueprint $table) {
            $table->increments('id');

            /**
             * Data Pemohon
             */
            $this->generateField($table, self::DATA_PEMOHON);


            /**
             * Data Catin
             */
            $this->generateField($table, self::DATA_CATIN);

            /**
             * Data Ayah
            */
            $this->generateField($table, self::DATA_AYAH);

            /**
             * Data Ibu
             */
            $this->generateField($table, self::DATA_IBU);

            /**
             * untuk scope per kelurahan
             */
            $table->unsignedBigInteger('village_id');

            $table->foreign('village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedInteger('no');

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
        Schema::table('surat_nikah', function (Blueprint $table) {
            $this->removeRelation($table, self::DATA_PEMOHON);
            $this->removeRelation($table, self::DATA_CATIN);
            $this->removeRelation($table, self::DATA_AYAH);
            $this->removeRelation($table, self::DATA_IBU);

            /**
             * scope per kelurahan
             */
            $table->dropForeign(['village_id']);
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('surat_nikah');

        Schema::dropIfExists('surat_nikah');
    }

    private function removeRelation(Blueprint $table, $what)
    {
        $table->dropForeign([$what . '_religion_id']);
        $table->dropForeign([$what . '_education_id']);
        $table->dropForeign([$what . '_job_id']);
        $table->dropForeign([$what . '_village_id']);

        if ($what == self::DATA_PEMOHON) {
            $table->dropForeign([$what . '_marital_status_id']);
            $table->dropForeign([$what . '_status_hub_keluarga_id']);
        }
    }

    private function generateField(Blueprint $table, $what)
    {
        $table->string($what . '_nama', 50);

        if ($what == self::DATA_PEMOHON) {
            $table->char($what . '_nik', 16)->unique();
            $table->char($what . '_nomor_kk', 16);
            $table->unsignedInteger($what . '_marital_status_id');
            $table->unsignedInteger($what . '_status_hub_keluarga_id');
            $table->string($what . '_nama_ayah', 50);
            $table->string($what . '_nama_ibu', 50);
            $table->enum($what . '_jenis_kelamin', ['M', 'F']);

            $table->foreign($what . '_marital_status_id')
                ->references('id')
                ->on('marital_status')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign($what . '_status_hub_keluarga_id')
                ->references('id')
                ->on('status_hubungan_keluarga')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        }

        if ($what == self::DATA_CATIN) {
            $table->string($what . '_nama_ayah', 50);
            $table->enum($what . '_jenis_kelamin', ['M', 'F']);
        }

        $table->string($what . '_tempat_lahir', 50);
        $table->date($what . '_tanggal_lahir');
        $table->enum($what . '_golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
        $table->unsignedInteger($what . '_religion_id');
        $table->unsignedInteger($what . '_education_id');
        $table->unsignedInteger($what . '_job_id');
        $table->unsignedBigInteger($what . '_village_id');
        $table->string($what . '_alamat', 30);
        $table->string($what . '_rt', 3);
        $table->string($what . '_rw', 3);
        $table->enum($what . '_kewarganegaraan', ['WNI', 'WNA']);

        $table->foreign($what . '_religion_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        $table->foreign($what . '_education_id')
                ->references('id')
                ->on('education')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        $table->foreign($what . '_job_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        $table->foreign($what . '_village_id')
                ->references('id')
                ->on('village')
                ->onDelete('restrict')
                ->onUpdate('cascade');
    }
}
