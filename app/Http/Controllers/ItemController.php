<?php

namespace App\Http\Controllers;

use App\Models\{Category, Item};
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function show(string $category, string $item): View
    {
        $item = Item::whereSlug($item)->first();
        $additionalItems = Category::whereSlug($category)
            ->first()
            ->items()
            ->where('item_id', '<>', $item->id)
            ->take(5)
            ->inRandomOrder()
            ->get();
        return view('item.show', compact('item', 'additionalItems'));
    }
}
