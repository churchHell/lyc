<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ImageItem
 *
 * @property int $id
 * @property int $image_id
 * @property int $item_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImageItem extends Pivot
{
    //
}
