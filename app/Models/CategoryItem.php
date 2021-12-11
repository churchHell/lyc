<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CategoryItem
 *
 * @property int $id
 * @property int $category_id
 * @property int $item_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryItem extends Pivot
{
    //
}
