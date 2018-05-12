<?php

namespace App\Modules\Core\Models;

class Privilege extends TrackableModel
{
    protected $fillable = ['name', 'label', 'menu'];
    protected $with = [];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'privileges_groups', 'privileges_id', 'groups_id');
    }

    /**
     *
     * @param string $name
     * @param string $label
     * @param string $menu
     *
     * @return array
     *
     */
    public static function generatePrivilege(string $name, string $label, string $menu)
    {
        return [
            'name' => $name,
            'label' => $label,
            'menu' => $menu,
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
