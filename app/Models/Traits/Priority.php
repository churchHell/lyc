<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Priority
{

    public function scopeOrderBy(Builder $query): Builder
    {
        return $query->orderBy('priority', 'asc');
    }

}