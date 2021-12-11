<?php

namespace App\Http\Livewire\Cart;

use App\Http\Livewire\BaseComponent;
use App\Models\{Purchase};
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Barryvdh\Debugbar\Facade as Debugbar;

class Show extends BaseComponent
{
    use AuthorizesRequests;

    public ?int $purchaseId;
    public string $image = '';
    public array $item;
    public int $price;
    public string $qty;
    public int $total;
    public $created_at;

    protected array $rules = ['qty' => 'required|integer|min:1'];

    public function mount(Purchase $purchase)
    {
        $this->purchaseId = $purchase->id;
        $this->image = $purchase->item->image->path;
        $this->item = $purchase->item->toArray();
        $this->price = $purchase->price;
        $this->qty = $purchase->qty;
        $this->total = $purchase->total;
        $this->created_at = $purchase->created_at->formatLocalized('%d %B %Y');
        // $this->created_at = $purchase->created_at->formatLocalized('%d %F %Y в %H:%i');
    }

    public function update(): void
    {        
        $purchase = Purchase::findOrFail($this->purchaseId);
        $this->authorize('update', $purchase);
        if($this->resultIcon($purchase->update($this->validate()), 'updated', 'notUpdated')){
            $this->total = $purchase->total;
            $this->emitTo('cart.index', 'render');
            $this->render();
        }
    }

    public function delete(): void
    {        
        $purchase = Purchase::findOrFail($this->purchaseId);
        $this->authorize('delete', $purchase);
        if($purchase->delete()){
            $this->emit('deleted');
            $this->emitTo('cart.icon', 'render');
            $this->emitTo('cart.index', 'render');
        }
        else {
            $this->emit('notDeleted');
        }
    }

    public function render()
    {
        return view('livewire.cart.show');
    }
}
