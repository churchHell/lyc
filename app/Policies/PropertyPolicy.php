<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
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
    public function update(User $user, Property $unit)
    {
        return true;
    }

    public function delete(User $user, Property $unit)
    {
        return true;
    }
}
