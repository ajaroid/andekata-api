<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;
use App\Modules\Core\Models\Employee;

class Village extends CoreModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'village';
    protected $fillable = ['name', 'code', 'subdistrict_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id');
    }

    public function villageIdentity()
    {
        return $this->belongsTo(VillageIdentity::class, 'id', 'village_id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'id', 'village_id');
    }

    public function permohonanKK()
    {
        return $this->belongsTo(PermohonanKK::class, 'kelurahan_id');
    }
}
