<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class MaritalStatus extends CoreModel
{
    protected $table   = 'marital_status';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
