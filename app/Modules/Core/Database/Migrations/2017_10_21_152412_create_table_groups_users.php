<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroupsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_users', function (Blueprint $table) {
            $table->integer('groups_id')->unsigned();
            $table->integer('users_id')->unsigned();
            
            $table->foreign('groups_id')
                ->references('id')
                ->on('groups')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('users_id')
                ->references('id')
                ->on('users')
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
        Schema::table('groups_users', function (Blueprint $table) {
            $table->dropForeign('groups_users_groups_id_foreign');
            $table->dropForeign('groups_users_users_id_foreign');
        });

        Schema::dropIfExists('groups_users');
    }
}
