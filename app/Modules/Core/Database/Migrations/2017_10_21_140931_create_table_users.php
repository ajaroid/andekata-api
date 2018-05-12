<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Core\Helpers\TrackablesMigration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('village_id')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0)
                ->comment('0 = pending 1 = activated 2 = deactivated');
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->integer('approved_by')->unsigned()->nullable();

            $table->foreign('approved_by')
                ->references('id')
                ->on('users')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_approved_by_foreign');
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('users');

        Schema::dropIfExists('users');
    }
}
