<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrivilegesGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges_groups', function (Blueprint $table) {
            $table->integer('privileges_id')->unsigned();
            $table->integer('groups_id')->unsigned();
            
            $table->foreign('privileges_id')
                ->references('id')
                ->on('privileges')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('groups_id')
                ->references('id')
                ->on('groups')
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
        Schema::table('privileges_groups', function (Blueprint $table) {
            $table->dropForeign('privileges_groups_privileges_id_foreign');
            $table->dropForeign('privileges_groups_groups_id_foreign');
        });

        Schema::dropIfExists('privileges_groups');
    }
}
