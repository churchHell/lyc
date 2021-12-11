<?php

namespace App\Policies;

use App\Models\{Cart, Item, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

   public function before(User $user = null)
   {
       if(!$user){
           return false;
       }
   }

    public function view(User $user, Cart $cart)
    {
        //
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Cart $cart)
    {
        return $cart->user_id == $user->id;
    }

    public function delete(User $user, Cart $cart)
    {
        return $cart->user_id == $user->id;
    }

}
