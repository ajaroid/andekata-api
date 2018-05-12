<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Core\Helpers\TrackablesMigration;

class CreateTablePositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('dept_id')->unsigned()->nullable();

            $table->foreign('dept_id')
                ->references('id')
                ->on('depts')
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
        Schema::table('positions', function (Blueprint $table) {
            $table->dropForeign('positions_dept_id_foreign');
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('positions');

        Schema::dropIfExists('positions');
    }
}
