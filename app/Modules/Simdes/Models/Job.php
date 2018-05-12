<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Job extends CoreModel
{
    protected $table = 'job';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
