<?php

namespace App\Models;

use App\Models\Traits\TotalPrice;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Cart extends Model
{
    use HasFactory, TotalPrice;

    protected $fillable = ['item_id', 'qty', 'price', 'order_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class)->whereDoesntHave('order');
    }

    public function actualPurchases(): HasMany
    {
//        dd($this->purchases()->where(['order'=> fn($order)=>dd($order->get())]));
//        dd($this->purchases()->with('order')->get()->first()->order->first()->pivot);
//        return $this->purchases()->with('order');
        return $this->purchases()->where('order', fn($order) => !$order->first()->exists);
    }

//    public function scopeActual(Builder $query): Builder
//    {
//        return $query->whereNull('order_id');
//    }

    public function scopeActual(Builder $query): Builder
    {
        return $query->with('order');
        return $query->whereHas('order', fn($order) => dd($order));
    }
}
