<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Livewire\Component;

class Categories extends Component
{

    use AuthorizesRequests;

    public array $categories = [];
    public string $itemId;

    public function mount(array $itemCategories): void
    {
        $this->categories = Category::whereNotIn('id', Arr::pluck($itemCategories, 'id'))->get()->toArray();
    }

    public function add(int $id): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->categories()->attach($id);
        $this->emit('categoryAdded');
    }

    public function delete(int $id): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->categories()->detach($id);
        $this->emit('categoryAdded');
    }

    public function render()
    {
        return view('livewire.admin.categories');
    }
}
