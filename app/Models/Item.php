<?php

namespace App\Models;

use App\Casts\Price;
use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\{BelongsToMany};

class Item extends Model
{
    use HasFactory, Active;

    protected $fillable = ['name', 'description', 'slug', 'qty', 'price', 'active'];
    protected $with = ['categories', 'images', 'properties'];
    protected $casts = ['price' => Price::class];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps()->using(CategoryItem::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('value')->withTimestamps()->using(ItemProperty::class);
    }

    public function scopeActive(Builder $query, bool $active = true): Builder
    {
        return $query->whereActive($active)->whereHas('categories', fn($query) => $query->whereActive(1));
    }

    public function getImageAttribute(): Image
    {
        return $this->images->first() ?? new Image;
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }

    public function image(int $id): Image
    {
        return $this->images()->whereImageId($id)->first();
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

}
