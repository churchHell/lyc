<?php

namespace App\Models;

use App\Casts\Name;
use App\Models\Traits\{FullName, Phone, TotalPrice};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, Notifiable, FullName, Phone, TotalPrice;

    protected $fillable = ['name', 'surname', 'patronymic', 'phone', 'index', 'city', 'address', 'delivery_id', 'comment', 'status_id', 'payment_status', 'payment_error', 'payment_action_description'];
    protected $casts = ['name' => Name::class, 'surname' => Name::class, 'created_at' => 'datetime'];

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Purchase::class)->withTimestamps();
    }

    public function promocodes(): BelongsToMany
    {
        return $this->belongsToMany(Promocode::class)->withTimestamps();
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getCreatedAttribute(): string
   {
       return $this->created_at->format('d.m.Y в H:i');
   }
    
}
