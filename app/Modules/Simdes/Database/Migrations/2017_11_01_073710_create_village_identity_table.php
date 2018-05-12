<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_identity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id');
            $table->string('headman_name', 100)->nullable();
            $table->string('headman_nip', 20)->nullable();
            $table->string('head_subdistrict_name', 100)->nullable();
            $table->string('head_subdistrict_nip', 20)->nullable();
            $table->string('regent_name', 100)->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('website', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('logo')->nullable();
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
        Schema::table('village_identity', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });

        Schema::dropIfExists('village_identity');
    }
}
