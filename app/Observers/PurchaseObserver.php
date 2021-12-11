<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver
{
    public function retrieved(Purchase $purchase)
    {
        // $purchase->total = $purchase->qty * $purchase->price;
    }
}
