<?php

namespace App\Http\Livewire\Cart;

use App\Http\Livewire\BaseComponent;
use App\Models\{Purchase};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends BaseComponent
{
    use AuthorizesRequests;

    public ?int $purchaseId;
    public string $image = '';
    public array $item;
    public string $price;
    public ?string $total_without_discount = null;
    public string $qty;
    public string $total;
    public $created;

    protected array $rules = ['qty' => 'required|integer|min:1'];

    protected $listeners = ['promocodeAccepted'];

    public function mount(Purchase $purchase)
    {
        $this->purchaseId = $purchase->id;
        $this->image = $purchase->item->image->path;
        $this->item = $purchase->item->toArray();
        $this->price = $purchase->price;
        $this->qty = $purchase->qty;
        $this->total = $purchase->total;
        $this->created = $purchase->created;
        $this->total_without_discount = $purchase->total_without_discount;
    }

    public function update(): void
    {        
        if(!$this->purchaseId){
            return;
        }
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
        if(!$this->purchaseId){
            return;
        }
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

    public function promocodeAccepted(array $purchases): void
    {
        // foreach($purchases as $purchase){
        //     if($this->purchaseId == $purchase['id'] && !empty($purchase['total_without_discount'])){
        //         $model = new Purchase($purchase);
        //         $this->total_without_discount = $purchase['total_without_discount'];
        //         $this->total = $model->total;
        //         break;
        //     }
        // }
    }

    public function render()
    {
        return view('livewire.cart.show');
    }
}
