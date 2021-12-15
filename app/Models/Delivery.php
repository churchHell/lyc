<?php

namespace App\Models;

use App\Casts\Price;
use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory, Active;

    protected $fillable = ['name', 'description', 'price', 'active_free_price', 'free_price', 'active'];
    protected $casts = ['price' => Price::class, 'free_price' => Price::class];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function setWithDiscount($price): void
    {
        $this->price =  $this->active_free_price
            && !empty($this->free_price)
            && $price >= $this->free_price
            ? 0
            : $this->price;
    }
}
