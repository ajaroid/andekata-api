<?php

namespace App\Modules\Core\Models;

class Position extends TrackableModel
{
    protected $fillable = ['name', 'code', 'dept_id'];

    public function department ()
    {
        return $this->belongsTo(Dept::class, 'dept_id');
    }
}
