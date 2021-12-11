<?php

namespace App\Observers;

use App\Exceptions\NotEmptyException;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category)
    {
        if(empty($category->slug)){
            $category->slug = Str::slug($category->name);
        }
    }

    public function updating(Category $category)
    {
        $category->slug = Str::slug($category->name);
    }

    public function deleting(Category $category)
    {
        throw_if($category->items->count() > 0, new NotEmptyException);
    }
}
