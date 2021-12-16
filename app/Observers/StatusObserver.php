<?php

namespace App\Observers;

use App\Exceptions\DuplicateException;
use App\Exceptions\NotEmptyException;
use App\Models\Status;

class StatusObserver
{
    
    public function deleting(Status $status)
    {
        throw_if($status->orders->count() > 0, new NotEmptyException);
    }

    public function creating(Status $status)
    {
        throw_if(Status::whereName($status->name)->exists(), new DuplicateException);
    }

}
