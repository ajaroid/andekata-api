<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Yuana <andhikayuana@gmail.com>
 * @since mon, 30 oct 2017
 *
 * BaseModel class
 */
abstract class BaseModel extends Model
{
    /**
     * @var relations constant
     */
    const BELONGS_TO = 'belongsTo';
    const HAS_ONE = 'hasOne';
    const HAS_MANY = 'hasMany';
    const BELONGS_TO_MANY = 'belongsToMany';

    /**
     * [$attributeRelations for model relations]
     * @var array
     */
    public $attributeRelations = [];

    public function __construct(array $attributes = [])
    {
        $this->addRelations($this->relations());

        parent::__construct($attributes);
    }

    /**
     * [addRelations description]
     * @param array $relations [description]
     * @return void
     */
    public function addRelations($relations = [])
    {
        $this->attributeRelations = $relations;
    }

    /**
     * [relations description]
     * @return array
     */
    abstract public function relations();

    public function __call($method, $args)
    {
        if (array_key_exists($method, $this->attributeRelations)) {
            $attr = $this->attributeRelations;
            
            /**
             * idx : 0 => method relation like belongsTo, hasOne, hasMany
             * idx : 1 => model class name
             * idx : 2 => field | foreign key
             * idx : 3 => field | local key
             * --
             * example :
             * return $this->$attr[$method][0]($attr[$method][1], $attr[$method][2]);
             * like :
             * return $this->belongsTo('App\Models\User', 'created_by');
             */

            if (isset($attr[$method][4])) {
                return $this->{$attr[$method][0]}(
                    $attr[$method][1], $attr[$method][2], $attr[$method][3], $attr[$method][4]
                );
            } elseif (isset($attr[$method][3])) {
                return $this->{$attr[$method][0]}($attr[$method][1], $attr[$method][2], $attr[$method][3]);
            } elseif (isset($attr[$method][2])) {
                return $this->{$attr[$method][0]}($attr[$method][1], $attr[$method][2]);
            }

            return $this->{$attr[$method][0]}($attr[$method][1]);
        } else {
            return parent::__call($method, $args);
        }
    }
}
