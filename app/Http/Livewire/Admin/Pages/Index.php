<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;

    public function activate(int $id)
    {
        $page = Page::findOrFail($id);
        $this->authorize('update', $page);
        if($page->activeToggle()){
            $this->render();
        }
    }

    public function delete(int $id)
    {
        $page = Page::findOrFail($id);
        $this->authorize('delete', $page);
        if($page->delete()){
            $this->render();
        }
    }

    public function render()
    {
        $pages = Page::all();
        return view('livewire.admin.pages.index', compact('pages'));
    }
}
