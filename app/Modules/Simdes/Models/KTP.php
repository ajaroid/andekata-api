<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class KTP extends CoreModel
{
    protected $table    = 'ktp';
    protected $fillable = [
        'kelurahan_id',
        'penduduk_id',
        'nama',
        'no_kk',
        'nik',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'jenis'
    ];
    protected $with = ['kelurahan.kecamatan.kabupaten.provinsi', 'penduduk'];

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan_id');
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id', 'penduduk_id');
    }
}
