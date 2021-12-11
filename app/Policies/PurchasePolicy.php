<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    public function update(User $user = null, Purchase $purchase)
    {
        dd($purchase);
        return $this->can($user, $purchase);
    }

    public function delete(User $user = null, Purchase $purchase)
    {
        return $this->can($user, $purchase);
    }

    private function can(User $user = null, Purchase $purchase): bool
    {
        return $purchase->cart->id == cartRepository()->getId();
    }
}
