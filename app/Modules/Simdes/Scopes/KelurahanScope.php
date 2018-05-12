<?php

namespace App\Modules\Simdes\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class KelurahanScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'kelurahan_id')) {
            $kelurahanId = env('APP_KELURAHAN_ID', null);
            if (!empty($kelurahanId)) {
                $builder->where('kelurahan_id', $kelurahanId);
            }
        }
    }
}
