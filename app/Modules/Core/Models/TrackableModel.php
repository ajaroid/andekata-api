<?php

namespace App\Modules\Core\Models;

use Auth;
use Illuminate\Support\Facades\Log;

class TrackableModel extends CoreModel
{
    protected $with = ['createdBy', 'updatedBy'];

    public function relations()
    {
        return [
            'createdBy' => [self::BELONGS_TO, User::class, 'created_by'],
            'updatedBy' => [self::BELONGS_TO, User::class, 'updated_by']
        ];
    }

    public static function boot()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });

        parent::boot();
    }
}
