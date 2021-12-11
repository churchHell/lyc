<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];
    protected $attributes = ['path' => 'empty.jpg'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function item(): Item
    {
        return $this->items()->first();
    }

}
