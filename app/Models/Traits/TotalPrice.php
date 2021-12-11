<?php

namespace App\Models\Traits;

trait TotalPrice
{

    public function getPriceAttribute(): string
    {
        return $this->purchases->sum('total');
    }

}