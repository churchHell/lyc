<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Active
{

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereActive(1);
    }

    public function activeToggle():bool
    {
        return $this->update(['active' => \DB::raw('NOT active')]);
    }

}