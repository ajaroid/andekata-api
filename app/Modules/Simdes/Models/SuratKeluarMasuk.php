<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\TrackableModel;

class SuratKeluarMasuk extends TrackableModel
{
    protected $table   = 'surat_keluar_masuk';
    protected $fillable = [
        'kelurahan_id',
        'no',
        'isi',
        'dari',
        'kepada',
        'tanggal',
        'keterangan',
        'jenis',
    ];
    protected $with = ['kelurahan'];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = date('Y-m-d', strtotime($value));
    }

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan_id');
    }
}
