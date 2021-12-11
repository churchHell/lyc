<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{

    public function deleting(Image $image)
    {
        $image->item()->images()->detach($image->id);
    }

    public function deleted(Image $image)
    {
        Storage::delete($image->path);
    }

}
