<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class KeperluanSurat extends CoreModel
{
    protected $table   = "keperluan_surat";
    protected $fillable = ['nama', 'kode_pelayanan', 'kode_surat', 'tipe', 'village_id'];
    protected $hidden = ['created_at', 'updated_at'];

    const SURAT_PENGANTAR = 1;
    const SURAT_KETERANGAN = 2;

    public function village()
    {
        $this->hasOne(Village::class, 'id', 'village_id');
    }
}
