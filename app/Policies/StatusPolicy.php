<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if(!$user->isAdmin()){
            return false;
        }
    }

    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, Status $status)
    {
        return true;
    }

    public function delete(User $user, Status $status)
    {
        return true;
    }

}
