<?php

namespace App\Http\Livewire\Cart;

use App\Models\{Cart, Item};
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use AuthorizesRequests;

    public int $itemId;

    public function mount(Item $item)
    {
        $this->itemId = $item->id;
    }

    public function store(): void
    {
        $item = Item::findOrFail($this->itemId);

        $cart = cartRepository()->getCart();

        $stored = $cart->purchases()->updateOrCreate(
            ['item_id' => $item->id],
            ['price' => $item->price, 'qty' => \DB::raw('qty + 1')]
        );

        if($stored){
            $this->emit('stored');
            $this->emitTo('cart.icon', 'render');
        }
        else {
            $this->emit('noStored');
        }
    }

    public function render()
    {
        return view('livewire.cart.create');
    }
}
