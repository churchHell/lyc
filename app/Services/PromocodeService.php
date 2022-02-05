<?php

namespace App\Services;

use App\Models\Promocode;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Collection;

class PromocodeService
{

    public function acceptPromocode(Collection $purchases, Promocode $promocode): Collection
    {
        $purchases = $purchases->sortBy('price');
        if($promocode->every_item > 0 && $promocode->percentage_discount > 0){
            $purchases = $this->everyPercentageDiscount($purchases, $promocode);
        }
        if($promocode->gift_item_id){
            $purchases = $this->addGiftItem($purchases, $promocode);
        }
        return $purchases;
    }

    protected function everyPercentageDiscount(Collection $purchases, Promocode $promocode): Collection
    {
        $discountCount = floor($purchases->count() / $promocode->every_item);
        $discountPurchases = $purchases->slice(0, $discountCount)->map(function($item) use ($promocode) {
            $item->total_without_discount = $item->total;
            $item->price *= $promocode->percentage_discount / 100;
            return $item;
        });
        $purchases = $purchases->merge($discountPurchases);
        return $purchases;
    }

    protected function addGiftItem(Collection $purchases, Promocode $promocode): Collection
    {
        $purchases->push(new Purchase([
            'cart_id' => $purchases->first()->cart_id,
            'item_id' => $promocode->gift_item_id,
            'qty' => 1,
            'price' => 0,
        ]));
        return $purchases;
    }

}