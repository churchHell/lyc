<?php

namespace App\Models\Traits;

trait TotalPrice
{

    public function getPriceAttribute(): int
    {
        return $this->purchases->sum('total');
    }

}