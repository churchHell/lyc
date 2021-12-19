<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function success(): View
    {
        return view('order.success');
    }

    public function error(): View
    {
        return view('order.error');
    }
}
