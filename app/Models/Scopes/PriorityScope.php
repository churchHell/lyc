<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PriorityScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        return $builder->orderBy('priority', 'asc');
    }
}