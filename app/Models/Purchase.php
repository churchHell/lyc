<?php

namespace App\Models;

use App\Casts\Price;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{

    use HasFactory;

    protected $fillable = ['cart_id', 'item_id', 'qty', 'price'];
    protected $with = ['item'];
    protected $casts = ['created_at' => 'datetime', 'price' => Price::class];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalAttribute()
    {
        return $this->qty * $this->price;
    }

    public function getOriginalTotalAttribute()
    {
        return $this->qty * $this->getOriginal('price');
    }

   public function getCreatedAttribute(): string
   {
       return $this->created_at->format('d.m.Y в H:i');
   }

}
