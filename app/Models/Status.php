<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\{HasMany};

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
