<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Core\Helpers\TrackablesMigration;

class CreateTablePrivileges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label');
            $table->string('menu');

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
        TrackablesMigration::getInstance()->removeTrackablesColumn('privileges');

        Schema::dropIfExists('privileges');
    }
}
