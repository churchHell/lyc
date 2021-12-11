<?php

namespace App\Http\Livewire\Cart;

use App\Models\{Cart};
use App\Http\Livewire\BaseComponent;
use App\Services\CartService;

class Icon extends BaseComponent
{

    protected $listeners = ['render'];    

    public function render()
    {
        $cartId = getCartId();
        $count = (int)($cartId 
                ? optional(Cart::whereId($cartId)->withCount('purchases')->first())->purchases_count 
                : 0);
        return view('livewire.cart.icon', compact('count'));
    }
}
