<?php

namespace App\Services;

use App\Models\{Cart, Item};
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;

class CartService
{

    public function to($id): int
    {
        Cookie::queue(Cookie::forever('cartId', $id));
    }

    public function store(int $itemId)
    {
        $cart = $this->fromCookie();
        @$cart[$itemId] += 1;
        $this->toCookie($cart);
    }

    public function update(int $itemId, int $qty)
    {
        $cart = $this->fromCookie();
        $cart[$itemId] = $qty;
        $this->toCookie($cart);
    }

    public function delete(int $itemId)
    {
        $cart = $this->fromCookie();
        unset($cart[$itemId]);
        $this->toCookie($cart);
    }

    public function get(int $itemId = null): Collection
    {
        $cookieItems = $this->fromCookie();
        if(!empty($itemId) && !empty($cookieItems[$itemId])){
            $cookieItems = Arr::only($cookieItems, [$itemId]);
        }
        $ids = array_keys($cookieItems);
        $cart = collect();
        if(count($ids) > 0){
            $items = Item::whereIn('id', $ids)->with('properties')->get();
            foreach($items as $item){
                $cart->push(Cart::make(['item_id' => $item->id, 'qty' => $cookieItems[$item->id]])->setRelation('item', $item));
            }
        }
        return $cart;
    }

    private function fromCookie(): array
    {
        return Cookie::has('cart') ? unserialize(Cookie::get('cart')) : [];
    }

    private function toCookie(array $cart): void
    {
        Cookie::queue(Cookie::forever('cart', serialize($cart)));
    }

}