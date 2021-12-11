<?php

namespace App\Http\Controllers;

use App\Mail\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CartController extends Controller
{
    
    public function index(): View
    {
        return view('cart.index');
    }

}
