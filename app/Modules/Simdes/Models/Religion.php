<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Religion extends CoreModel
{
    protected $table   = 'religion';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
