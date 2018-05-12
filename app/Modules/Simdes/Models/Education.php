<?php

namespace App\Modules\Simdes\Models;

use App\Modules\Core\Models\CoreModel;

class Education extends CoreModel
{
    protected $table = 'education';
    protected $fillable = ['name'];
    public $timestamps = false;
}
