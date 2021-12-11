<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{

    use AuthorizesRequests;

    public bool $active;
    public array $item;
    public string $categorySlug;

    public function mount(Item $itemModel): void
    {
        $itemModel->image = $itemModel->image;
        $this->active = $itemModel->active;
        $this->item = $itemModel->toArray();
    }

    public function activate(): void
    {
        $item = Item::findOrFail($this->item['id']);
        $this->authorize('update', $item);
        if($item->activeToggle()){
            $this->item['active'] = !$this->item['active'];
        }
    }

    public function render()
    {
        return view('livewire.admin.items.show');
    }
}
