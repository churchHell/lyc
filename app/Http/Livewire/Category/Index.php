<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{

    public string $slug = '';

    protected $listeners = ['cartStored'];

    public function cartStore(int $id)
    {
        $this->emitTo('cart.icon', 'store', $id);
    }

    public function cartStored(bool $stored, int $itemId)
    {
        if($stored){
            $this->emit("cartStored-".$itemId);
        }
    }
    
    public function render()
    {
        $category = Category::whereSlug($this->slug)
            ->with(['items' => fn($query) => $query->active()])
            ->first();
        return view('livewire.category.index', compact('category'));
    }
}
