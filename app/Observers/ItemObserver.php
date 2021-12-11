<?php

namespace App\Observers;

use App\Exceptions\ItemDuplicateException;
use App\Models\Item;
use Illuminate\Support\Str;

class ItemObserver
{

    public function creating(Item $item)
    {
        $item = $this->slug($item);
        throw_if(Item::whereSlug($item->slug)->exists(), new ItemDuplicateException);
    }

    public function updating(Item $item)
    {
        $item = $this->slug($item);
    }

    private function slug(Item $item): Item
    {
        $item->slug = Str::slug($item->name);
        return $item;
    }

}
