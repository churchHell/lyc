<?php

namespace App\Http\Livewire\Cart;

use App\Models\{Purchase, SettingsKey};
use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    public bool $orderCreated = false;
    public array $settings = [];

    protected $listeners = ['orderCreated', 'render'];

    public function mount(): void
    {
        $this->settings = SettingsKey::whereSlug('order')->first()->settings->keyBy('slug')->toArray();
    }

    public function orderCreated()
    {
        $this->orderCreated = true;
        $this->render();
    }

    public function render()
    {
        $cart = cartRepository()->getCart()->load('purchases');
        return view('livewire.cart.index', compact('cart'));
    }
}
