<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['value'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(DataType::class, 'data_type_id');
    }
}
