<?php

namespace App\Http\Livewire\Items;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public string $slug = '';
    public string $search = '';

    public function render()
    {
        try {
            $items = $this->slug
                ? Category::whereSlug($this->slug)
                    ->active()
                    ->first()
                    ->items()
                    ->search($this->search)
                    ->active()
                    ->paginate(20)
                : Item::active()
                    ->search($this->search)
                    ->latest()
                    ->paginate(20);
        } catch (\Error $e){
            $items = collect();
        }

        return view('livewire.items.index', compact('items'));
    }
}
