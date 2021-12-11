<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(): View
    {
        return view('admin.units.index');
    }
}
