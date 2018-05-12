<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('provincy_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('provincy_id')
                ->references('id')
                ->on('provincy')
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
        Schema::table('regency', function (Blueprint $table) {
            $table->dropForeign(['provincy_id']);
        });

        Schema::dropIfExists('regency');
    }
}
