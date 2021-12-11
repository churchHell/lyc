<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    
    public function index(): View
    {
        return view('admin.pages.index');
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function edit(int $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }
}
