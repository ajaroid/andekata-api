<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class KKDetail extends CoreModel
{
    protected $table    = 'kartu_keluarga_detail';
    protected $guarded  = [];
    protected $with     = ['kk', 'penduduk', 'shk'];

    public function kk()
    {
        return $this->hasOne(KK::class, 'id', 'kk_id');
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id', 'penduduk_id');
    }

    public function shk()
    {
        return $this->hasOne(SHK::class, 'id', 'status_hubungan_keluarga_id');
    }
}
