<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class VillageIdentity extends CoreModel
{
    protected $table = 'village_identity';
    protected $guarded = [];
    protected $fillable = [
        'village_id',
        'headman_name',
        'headman_nip',
        'head_subdistrict_name',
        'head_subdistrict_nip',
        'regent_name',
        'address',
        'phone',
        'website',
        'email',
        'logo'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['village.subdistrict.regency.provincy'];

    public function village()
    {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }
}
