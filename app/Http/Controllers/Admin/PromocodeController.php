<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromocodeController extends Controller
{
    protected array $types = [
        'free_delivery' => 'checkbox',
        'starts_at' => 'date',
        'ends_at' => 'date',
        'active' => 'checkbox',
    ];

    public function index(): View
    {
        return view('admin.promocodes.index');
    }

    public function create(): View
    {
        $fields = [
            'code'=> null,
            'description' => null,
            'min_price' => null,
            // 'min_qty' => null,
            'every_item' => null,
            'percentage_discount' => null,
            // 'fixed_discount' => null,
            // 'free_delivery' => false,
            'gift_item_id' => null,
            'starts_at' => null,
            'ends_at' => null,
            'active' => true,
        ];
        $types = $this->types;
        return view('admin.promocodes.create', compact('fields', 'types'));
    }

    public function edit(Promocode $promocode): View
    {
        $types = $this->types;
        return view('admin.promocodes.edit', compact('promocode', 'types'));
    }
}
