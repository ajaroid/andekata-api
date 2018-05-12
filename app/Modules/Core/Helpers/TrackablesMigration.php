<?php

namespace App\Modules\Core\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * TrackablesMigration class
 * this class for creating/removing (drop foreign) trackables column
 *
 * created_at
 * updated_at
 *
 * created_by
 * updated_by
 *
 * @author Yuana
 * @since sat, 21 oct 2017
 */
class TrackablesMigration
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function addTrackablesColumn(Blueprint $table)
    {
        $table->timestamp('created_at')->default(DB::raw('NOW()'));
        $table->timestamp('updated_at')->default(DB::raw('NOW()'));

        $table->integer('created_by')->unsigned()->nullable();
        $table->integer('updated_by')->unsigned()->nullable();

        $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');

        $table->foreign('updated_by')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');
    }

    public function removeTrackablesColumn($tableName)
    {

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (Schema::hasColumn($tableName, 'created_by')) {
                $table->dropForeign($tableName . '_created_by_foreign');
            }
            if (Schema::hasColumn($tableName, 'updated_by')) {
                $table->dropForeign($tableName . '_updated_by_foreign');
            }
        });
    }
}
