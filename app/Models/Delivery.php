<?php

namespace App\Models;

use App\Casts\Price;
use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory, Active;

    protected $fillable = ['name', 'description', 'price', 'active'];
    protected $casts = ['price' => Price::class];
}
