<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Provincy extends CoreModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'provincy';
    protected $fillable = ['name', 'code'];
    protected $hidden = ['created_at', 'updated_at'];

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'provincy_id');
    }
}
