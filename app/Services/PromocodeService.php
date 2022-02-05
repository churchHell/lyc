<?php

namespace App\Services;

use App\Models\Promocode;
use Illuminate\Database\Eloquent\Collection;

class PromocodeService
{

    public function acceptPromocode(Collection $purchases, Promocode $promocode): Collection
    {
        $purchases = $purchases->sortBy([['price', 'desc']]);
        if($promocode->every_item > 0 && $promocode->percentage_discount > 0){
            $purchases = $this->everyPercentageDiscount($purchases, $promocode);
        }
        return $purchases;
    }

    protected function everyPercentageDiscount(Collection $purchases, Promocode $promocode): Collection
    {
        foreach($purchases as $key => &$purchase){
            if(($key +1) % $promocode->every_item != 0){
                continue;
            }
            // $purchase->price_without_discount = $purchase->price;
            $purchase->total_without_discount = $purchase->total;
            $purchase->price *= $promocode->percentage_discount / 100;
            // $purchase->total *= $promocode->percentage_discount / 100;
        }
        unset($purchase);
        return $purchases;
    }

}