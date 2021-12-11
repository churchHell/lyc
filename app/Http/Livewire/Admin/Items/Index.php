<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\Category;
use Livewire\Component;
use App\Models\Item;

class Index extends Component
{
    public ?int $categoryId = null;

    public function render()
    {
        $items = collect();
        $categories = Category::get()->keyBy('id');
        if($this->categoryId) {
            $items = $categories->get($this->categoryId)->items;
        }
        return view('livewire.admin.items.index', compact( 'categories', 'items'));
    }
}
