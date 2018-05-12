<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\User;
use App\Modules\Core\Models\TrackableModel;
use App\Modules\Core\Helpers\NumberingUtil;

class SuratNikah extends TrackableModel
{
    protected $table = 'surat_nikah';
    protected $fillable = [
        'village_id',
        'no',

        'pemohon_nama',
        'pemohon_nik',
        'pemohon_nomor_kk',
        'pemohon_marital_status_id',
        'pemohon_status_hub_keluarga_id',
        'pemohon_nama_ayah',
        'pemohon_nama_ibu',
        'pemohon_jenis_kelamin',
        'pemohon_tempat_lahir',
        'pemohon_tanggal_lahir',
        'pemohon_golongan_darah',
        'pemohon_religion_id',
        'pemohon_education_id',
        'pemohon_job_id',
        'pemohon_village_id',
        'pemohon_alamat',
        'pemohon_rt',
        'pemohon_rw',
        'pemohon_kewarganegaraan',

        'catin_nama',
        'catin_nama_ayah',
        'catin_jenis_kelamin',
        'catin_tempat_lahir',
        'catin_tanggal_lahir',
        'catin_golongan_darah',
        'catin_religion_id',
        'catin_education_id',
        'catin_job_id',
        'catin_village_id',
        'catin_alamat',
        'catin_rt',
        'catin_rw',
        'catin_kewarganegaraan',

        'ayah_nama',
        'ayah_tempat_lahir',
        'ayah_tanggal_lahir',
        'ayah_golongan_darah',
        'ayah_religion_id',
        'ayah_education_id',
        'ayah_job_id',
        'ayah_village_id',
        'ayah_alamat',
        'ayah_rt',
        'ayah_rw',
        'ayah_kewarganegaraan',

        'ibu_nama',
        'ibu_tempat_lahir',
        'ibu_tanggal_lahir',
        'ibu_golongan_darah',
        'ibu_religion_id',
        'ibu_education_id',
        'ibu_job_id',
        'ibu_village_id',
        'ibu_alamat',
        'ibu_rt',
        'ibu_rw',
        'ibu_kewarganegaraan',

    ];

    public function relations()
    {
        return [
            'village' => [self::HAS_ONE, Village::class, 'id', 'village_id'],

            'pemohonMaritalStatus'  => [self::HAS_ONE, MaritalStatus::class, 'id', 'pemohon_marital_status_id'],
            'pemohonShk'            => [self::HAS_ONE, SHK::class, 'id', 'pemohon_status_hub_keluarga_id'],
            'pemohonReligion'       => [self::HAS_ONE, Religion::class, 'id', 'pemohon_religion_id'],
            'pemohonEducation'      => [self::HAS_ONE, Education::class, 'id', 'pemohon_education_id'],
            'pemohonJob'            => [self::HAS_ONE, Job::class, 'id', 'pemohon_job_id'],
            'pemohonVillage'        => [self::HAS_ONE, Village::class, 'id', 'pemohon_village_id'],

            'catinReligion'     => [self::HAS_ONE, Religion::class, 'id', 'catin_religion_id'],
            'catinEducation'    => [self::HAS_ONE, Education::class, 'id', 'catin_education_id'],
            'catinJob'          => [self::HAS_ONE, Job::class, 'id', 'catin_job_id'],
            'catinVillage'      => [self::HAS_ONE, Village::class, 'id', 'catin_village_id'],

            'ayahReligion'  => [self::HAS_ONE, Religion::class, 'id', 'ayah_religion_id'],
            'ayahEducation' => [self::HAS_ONE, Education::class, 'id', 'ayah_education_id'],
            'ayahJob'       => [self::HAS_ONE, Job::class, 'id', 'ayah_job_id'],
            'ayahVillage'   => [self::HAS_ONE, Village::class, 'id', 'ayah_village_id'],

            'ibuReligion'     => [self::HAS_ONE, Religion::class, 'id', 'ibu_religion_id'],
            'ibuEducation'    => [self::HAS_ONE, Education::class, 'id', 'ibu_education_id'],
            'ibuJob'          => [self::HAS_ONE, Job::class, 'id', 'ibu_job_id'],
            'ibuVillage'      => [self::HAS_ONE, Village::class, 'id', 'ibu_village_id'],

            'createdBy' => [self::BELONGS_TO, User::class, 'created_by'],
            'updatedBy' => [self::BELONGS_TO, User::class, 'updated_by']
        ];
    }

    public function getNoSurat()
    {

    }
}
