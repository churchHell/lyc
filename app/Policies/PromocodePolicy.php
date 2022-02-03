<?php

namespace App\Policies;

use App\Models\Promocode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromocodePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }
}
