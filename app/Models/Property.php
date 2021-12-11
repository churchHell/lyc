<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_id'];
    protected $with = ['unit'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
