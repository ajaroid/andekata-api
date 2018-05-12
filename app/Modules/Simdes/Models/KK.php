<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class KK extends CoreModel
{
    protected $table    = 'kartu_keluarga';
    protected $fillable  = ['nama', 'kelurahan_id', 'no_kk', 'alamat', 'rt', 'rw', 'kode_pos', 'status'];
    protected $with     = ['kelurahan'];

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan_id');
    }
}
