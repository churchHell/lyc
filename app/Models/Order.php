<?php

namespace App\Models;

use App\Casts\Name;
use App\Models\Traits\{FullName, Phone, TotalPrice};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, FullName, Phone, TotalPrice;

    protected $fillable = ['name', 'surname', 'patronymic', 'phone', 'index', 'city', 'address', 'delivery_id', 'comment', 'status_id'];
    protected $casts = ['name' => Name::class, 'surname' => Name::class];

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Purchase::class)->withTimestamps();
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    
}