<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Active;

class Page extends Model
{
    use HasFactory, Active;

    protected $fillable = ['name', 'slug', 'content', 'active', 'priority'];
}
