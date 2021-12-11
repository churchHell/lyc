<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ItemProperty
 *
 * @property int $id
 * @property int $item_id
 * @property int $property_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemProperty whereValue($value)
 * @mixin \Eloquent
 */
class ItemProperty extends Pivot
{
    protected $fillable = ['item_id', 'property_id', 'value'];
}
