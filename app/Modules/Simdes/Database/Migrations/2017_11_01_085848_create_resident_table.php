<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('religion_id');
            $table->unsignedInteger('marital_status_id');
            $table->unsignedInteger('status_hub_keluarga_id');
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('education_id');
            $table->unsignedBigInteger('village_id');
            $table->char('nik', 16)->unique();
            $table->string('name', 50);
            $table->enum('gender', ['M', 'F']);
            $table->string('birth_place', 50);
            $table->date('birth_date');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('father_name', 50);
            $table->string('mother_name', 50);
            $table->enum('citizenship', ['WNI', 'WNA']);
            $table->string('passport_number', 10)->nullable();
            $table->string('kitas_number', 15)->nullable();
            $table->enum('status', ['active', 'move', 'died']);
            $table->timestamps();

            $table->foreign('religion_id')
                ->references('id')
                ->on('religion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('marital_status_id')
                ->references('id')
                ->on('marital_status')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('status_hub_keluarga_id')
                ->references('id')
                ->on('status_hubungan_keluarga')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('job_id')
                ->references('id')
                ->on('job')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('education_id')
                ->references('id')
                ->on('education')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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
        Schema::table('resident', function (Blueprint $table) {
            $table->dropForeign(['religion_id']);
            $table->dropForeign(['marital_status_id']);
            $table->dropForeign(['status_hub_keluarga_id']);
            $table->dropForeign(['job_id']);
            $table->dropForeign(['education_id']);
            $table->dropForeign(['village_id']);
        });

        Schema::dropIfExists('resident');
    }
}
