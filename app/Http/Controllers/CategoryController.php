<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(string $slug = ''): View
    {
        return view('category.index', compact('slug'));
    }
}
