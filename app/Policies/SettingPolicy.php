<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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
    public function update(User $user, Setting $setting)
    {
        return true;
    }

    public function delete(User $user, Setting $setting)
    {
        return false;
    }
}
