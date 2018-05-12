<?php

namespace App\Modules\Core\Models;

use App\Modules\Simdes\Scopes\KelurahanScope;
use Illuminate\Support\Facades\Log;

class CoreModel extends BaseModel
{
    public function relations()
    {
        return [];
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new KelurahanScope);
    }

    /**
     * provide insert or update on duplicate key
     * @param $rows array
     * @param $key string for unique
     */
    public static function insertOnDuplicate(array $rows, $key)
    {
        $className = get_called_class();

        $table = \DB::getTablePrefix().with(new $className)->getTable();

        $first = reset($rows);

        $columns = implode( ',', array_map( function( $value ) {
            return "$value";
        } , array_keys($first) ));

        $values = implode( ',', array_map( function( $row ) {
                return '('.implode( ',',
                    array_map( function( $value ) {
                        return '"'.str_replace('"', '""', $value).'"';
                    } , $row )).')';
            } , $rows ));

        unset($first[$key]);

        $updates = implode( ',',
            array_map( function( $value ) {
                return "$value = VALUES($value)";
            } , array_keys($first) ));

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";

        return \DB::statement( $sql );
    }
}
