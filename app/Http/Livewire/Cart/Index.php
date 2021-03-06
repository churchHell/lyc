<?php

namespace App\Http\Livewire\Cart;

use App\Models\{Promocode, Purchase, SettingsKey};
use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    public bool $orderCreated = false;
    public array $settings = [];
    public ?array $delivery = null;
    public ?string $deliveryPrice = null;
    public ?Promocode $promocode = null;

    protected $listeners = ['render', 'orderCreated', 'deliverySelected', 'acceptPromocode', 'resetPromocode'];

    public function mount(): void
    {
        $this->settings = SettingsKey::whereSlug('order')->first()->settings->keyBy('slug')->toArray();
        $cart = cartRepository()->getCart()->load('purchases');

        optional($cart->purchases)->each(
            fn($purchase) => $purchase->updateIf(
                $purchase->created_at->diff(now())->days >= 1, 
                ['price' => $purchase->item->price]
            )
        );
    }

    public function orderCreated()
    {
        $this->orderCreated = true;
        $this->deliveryPrice = null;
        $this->render();
    }

    public function deliverySelected(array $delivery): void
    {
        $this->delivery = $delivery;
        $this->calculateDeliveryPrice();
    }

    private function calculateDeliveryPrice(): void
    {
        if(!$this->delivery){
            return;
        }
        $cart = cartRepository()->getCart()->load('purchases');
        $this->deliveryPrice = $this->delivery['active_free_price']
            && $this->delivery['free_price']
            && $cart->price >= $this->delivery['free_price']
            ? 0
            : $this->delivery['price'];
    }

    public function acceptPromocode(Promocode $promocode): void
    {
        $this->promocode = $promocode;
    }

    public function resetPromocode(): void
    {
        $this->promocode = null;
    }

    public function render()
    {
        $cart = cartRepository()->getCart()->load('purchases');
        if($this->promocode){
            $cart->purchases = promocodeService()->acceptPromocode($cart->purchases, $this->promocode);
            // $this->emit('promocodeAccepted', $cart->purchases->toArray());
        }
        $this->calculateDeliveryPrice();
        return view('livewire.cart.index', compact('cart'));
    }
}
