<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\TrackableModel;
use App\Modules\Core\Helpers\NumberingUtil;

class SuratPelayanan extends TrackableModel
{
    protected $table   = 'surat_pelayanan';
    protected $fillable = [
        'village_id',
        'keperluan_surat_id',
        'job_id',
        'religion_id',
        'no',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'kewarganegaraan',
        'alamat',
        'rt',
        'rw',
        'nik',
        'no_kk',
        'tgl_berlaku_dari',
        'tgl_berlaku_sampai',
        'keterangan',
    ];
    protected $with = [
        'village.subdistrict.regency.provincy',
        'village.villageIdentity',
        'job',
        'keperluanSurat',
        'religion'
    ];

    public function setTglBerlakuDariAttribute($value)
    {
        $this->attributes['tgl_berlaku_dari'] = date('Y-m-d', strtotime($value));
    }

    public function setTglBerlakuSampaiAttribute($value)
    {
        $this->attributes['tgl_berlaku_sampai'] = date('Y-m-d', strtotime($value));
    }

    public function village()
    {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    public function keperluanSurat()
    {
        return $this->hasOne(KeperluanSurat::class, 'id', 'keperluan_surat_id');
    }

    public function religion()
    {
        return $this->hasOne(Religion::class, 'id', 'religion_id');
    }

    public function getNoSurat()
    {
        $kode_surat = $this->keperluanSurat->kode_surat;
        $bulan = NumberingUtil::getInstance()->decimalToRomawi((int) $this->created_at->format('m'));
        return $this->no."/$kode_surat/$bulan/".$this->created_at->format('Y');
    }
}
