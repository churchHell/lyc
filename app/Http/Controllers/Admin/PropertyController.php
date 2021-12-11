<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\View\View;

class PropertyController extends Controller
{

    public function index(): View
    {
        return view('admin.properties.index');
    }

}
