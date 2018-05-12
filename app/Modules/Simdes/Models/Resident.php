<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;
use App\Modules\Core\Helpers\DateUtil;

class Resident extends CoreModel
{

    /***
     * Gender
     */
    const MALE = 'M';
    const FEMALE = 'F';

    /***
     * Blood Type
     */
    const A = 'A';
    const B = 'B';
    const AB = 'AB';
    const O = 'O';

    /***
     * Citizenship
     */
    const WNI = 'WNI';
    const WNA = 'WNA';

    /***
     * Status
     */
    const ACTIVE = 'active';
    const MOVE = 'move';
    const DIED = 'died';

    protected $table    = 'resident';
    protected $fillable  = [
        'religion_id',
        'education_id',
        'marital_status_id',
        'status_hub_keluarga_id',
        'job_id',
        'village_id',
        'nik',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'blood_type',
        'father_name',
        'mother_name',
        'citizenship',
        'passport_number',
        'kitas_number',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $with = [
        'religion',
        'maritalStatus',
        'job',
        'shk',
        'education',
        'village.subdistrict.regency.provincy'
    ];

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function religion()
    {
        return $this->hasOne(Religion::class, 'id', 'religion_id');
    }

    public function maritalStatus()
    {
        return $this->hasOne(MaritalStatus::class, 'id', 'marital_status_id');
    }

    public function shk()
    {
        return $this->hasOne(SHK::class, 'id', 'status_hub_keluarga_id');
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    public function education()
    {
        return $this->hasOne(Education::class, 'id', 'education_id');
    }

    public function permohonanKK()
    {
        return $this->belongsTo(PermohonanKK::class, 'kelurahan_id');
    }

    public static function parseData(int $villageId, array $resident)
    {
        return [
            'village_id' => $villageId,
            'religion_id' => self::parseReligion($resident['AGAMA']),
            'marital_status_id' => self::parseMaritalStatus($resident['STATUS_KAWIN']),
            'status_hub_keluarga_id' => self::parseStatusHubKeluarga($resident['SHDK']),
            'job_id' => self::parseJob($resident['PEKERJAAN']),
            'education_id' => self::parseEducation($resident['PENDIDIKAN']),
            'nik' => $resident['NIK'],
            'name' => $resident['NAMA_LGKP'],
            'gender' => $resident['JENIS_KELAMIN'] == 'LK' ? self::MALE : self::FEMALE,
            'birth_place' => $resident['TEMPAT_LAHIR'],
            'birth_date' => DateUtil::getInstance()->parseSimpleDate($resident['TANGGAL_LAHIR']),
            'blood_type' => $resident['GOLONGAN_DARAH'],
            'father_name' => $resident['NAMA_AYAH'],
            'mother_name' => $resident['NAMA_IBU'],
            'citizenship' => self::WNI,
            // 'passport_number' => '',
            // 'kitas_number' => '',
            'status' => self::ACTIVE
        ];
    }

    private static function parseReligion(String $religion)
    {
        return self::parseNameToId($religion, Religion::class);
    }

    private static function parseMaritalStatus(String $maritalStatus)
    {
        return self::parseNameToId($maritalStatus, MaritalStatus::class);
    }

    private static function parseStatusHubKeluarga(String $shk)
    {
        return self::parseNameToId($shk, SHK::class);
    }

    private static function parseJob(String $job)
    {
        return self::parseNameToId($job, Job::class);
    }

    private static function parseEducation(String $education)
    {
        return self::parseNameToId($education, Education::class);
    }

    private static function parseNameToId($name, $className)
    {
        $result = $className::where(['name' => strtolower($name)])->first();

        if (!$result) {
            $result = $className::create(['name' => title_case($name)]);
        }

        return $result->id;
    }
}
