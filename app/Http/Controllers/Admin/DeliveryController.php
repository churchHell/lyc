<?php

namespace App\Http\Controllers\Admin;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryController extends Controller
{

    public function index(): View
    {
        return view('admin.deliveries.index');
    }
}
