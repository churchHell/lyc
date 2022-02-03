<?php

namespace App\Models;

use App\Casts\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'min_price',
        'min_qty',
        'every_item',
        'percentage_discount',
        'fixed_discount',
        'free_delivery',
        'gift_item_id',
        'starts_at',
        'ends_at',
        'active',
    ];

    protected $casts = [
        'min_price' => Price::class,
        'starts_ad' => 'date',
        'ends_ad' => 'date',
        'active' => 'boolean',
    ];

}
