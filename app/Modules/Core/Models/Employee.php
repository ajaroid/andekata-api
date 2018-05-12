<?php

namespace App\Modules\Core\Models;

use App\Modules\Simdes\Models\Village;
use App\Modules\Simdes\Models\MaritalStatus;

class Employee extends TrackableModel
{
    /**
     * Gender
     */
    const GENDER_FEMALE = 'P';
    const GENDER_MALE   = 'L';

    /**
     * Job Status
     */
    const STATUS_CONTRACT   = 0;
    const STATUS_PERMANENT  = 1;

    /**
     * Employee Status
     */
    const STATUS_INACTIVE   = 0;
    const STATUS_ACTIVE     = 1;

    protected $fillable = [
        'code',
        'name',
        'address',
        'city',
        'birth_date',
        'birth_city',
        'gender',
        'marital_status_id',
        'job_status',
        'phone_number',
        'email',
        'position_id',
        'in_date',
        'out_date',
        'village_id',
        'status',
        'photo'
    ];

    protected $hidden = ['created_at', 'updated_at'];
    protected $with = [];

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function isActive()
    {
        return $this->status == Employee::STATUS_ACTIVE;
    }

    public function isContract()
    {
        return $this->job_status == Employee::STATUS_CONTRACT;
    }
}
