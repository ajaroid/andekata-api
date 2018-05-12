<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Core\Helpers\TrackablesMigration;

class CreateTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->date('birth_date');
            $table->string('birth_city');
            $table->enum('gender', ['L', 'P']);
            $table->unsignedInteger('marital_status_id');
            $table->tinyInteger('job_status')->comment('0 = contract, 1 = permanent');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->integer('position_id')->unsigned()->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->date('in_date')->nullable();
            $table->date('out_date')->nullable();
            $table->tinyInteger('status')->comment('0 = inactive, 1 = active');
            $table->string('photo')->nullable();

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            TrackablesMigration::getInstance()->addTrackablesColumn($table);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_position_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_employee_id_foreign');
        });

        TrackablesMigration::getInstance()->removeTrackablesColumn('employees');

        Schema::dropIfExists('employees');
    }
}
