<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class PermohonanKKDetail extends CoreModel
{
    protected $table   = 'permohonan_kk_detail';
    protected $guarded = [];
    protected $with    = ['permohonanKk', 'penduduk', 'shk'];

    public function permohonanKk()
    {
        return $this->hasOne(PermohonanKK::class, 'id', 'permohonan_kk_id');
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id', 'penduduk_id');
    }

    public function shk()
    {
        return $this->hasOne(SHK::class, 'id', 'status_hub_keluarga_id');
    }

}
