<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Regency extends CoreModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'regency';
    protected $fillable = ['name', 'code', 'provincy_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function provincy()
    {
        return $this->belongsTo(Provincy::class, 'provincy_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class, 'regency_id');
    }
}
