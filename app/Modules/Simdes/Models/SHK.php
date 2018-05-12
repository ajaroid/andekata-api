<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class SHK extends CoreModel
{
    protected $table   = 'status_hubungan_keluarga';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
