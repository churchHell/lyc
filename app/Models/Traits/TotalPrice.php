<?php

namespace App\Models\Traits;

trait TotalPrice
{

    public function getPriceAttribute(): float
    {
        $sum = $this->purchases->sum('total');
        return $sum;
    }

    public function getOriginalPriceAttribute(): float
    {
        $sum = $this->purchases->sum('original_total');
        return $sum;
    }

    // public function getOriginalPriceAttribute(): float
    // {
    //     $original = $this->purchases
    //         ->map(
    //             fn($purchase) => $purchase->getOriginal()
    //         )
    //         ->sum('total');
    //     $sum = $this->purchases->sum('total');
    //     return $sum;
    // }

}