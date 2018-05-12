<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Subdistrict extends CoreModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'subdistrict';
    protected $fillable = ['name', 'code', 'regency_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'subdistrict_id');
    }
}
