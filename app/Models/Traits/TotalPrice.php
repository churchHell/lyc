<?php

namespace App\Models\Traits;

trait TotalPrice
{

    public function getPriceAttribute(): float
    {
        $sum = $this->purchases->sum('total');
        return $sum;
    }

}