<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
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

    public function update(User $user, Delivery $delivery)
    {
        return true;
    }

    public function delete(User $user, Delivery $delivery)
    {
        return true;
    }
}
