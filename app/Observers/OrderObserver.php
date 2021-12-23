<?php

namespace App\Observers;

use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    

    public function creating(Order $order)
    {
       if(!$order->purchases->count()){
           return false;
       }
    }

    public function created(Order $order)
    {
        Mail::to(config('mail.from.address'))->queue(new OrderCreated($order));
    }

}
