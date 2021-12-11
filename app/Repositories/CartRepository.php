<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartRepository implements CartRepositoryInterface
{

    protected string $key = 'cartId';

    public function getId(): ?string
    {
        return auth()->check() ? auth()->user()->cart_id : $this->fromCookie();
    }

    public function setId(int $id): void
    {
        auth()->check()
            ? $user = auth()->user()->update(['cart_id' => $id])
            : Cookie::queue(Cookie::forever($this->key, $id));
    }

    public function getCart(): Cart
    {
        $cartId = $this->getId();
        $cart = Cart::firstOrCreate(['id' => $cartId]);
        if($cartId != $cart->id){
            $this->setId($cart->id);
        }
        return $cart;
    }

    public function fromCookie(): ?int
    {
        return Cookie::get($this->key);
    }

    public function forget(): void
    {
        Cookie::queue(Cookie::forget($this->key));
    }

    public function clear(): void
    {
        $this->getCart()->purchases()->delete();
    }

}