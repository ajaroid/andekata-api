<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class PermohonanKK extends CoreModel
{
    protected $table    = 'permohonan_kk';
    protected $fillable = [
        'kelurahan_id',
        'penduduk_id',
        'nama_id',
        'nik_id',
        'no_kk_lama',
        'alamat',
        'rt',
        'rw',
        'kelurahan_pemohon_id',
        'kode_pos',
        'no_telepon',
        'alasan',
        'jumlah_anggota_keluarga'
    ];
    protected $with = ['kelurahan', 'penduduk'];

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan_id');
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id', 'penduduk_id');
    }
}
