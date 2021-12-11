<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends BaseComponent
{

    use AuthorizesRequests;

    public ?int $pageId = null;

    public string $content = '';
    public string $name = '';
    public bool $active = true;

    protected array $rules = [
        'content' => 'string',
        'name' => 'required|string',
        'active' => 'boolean',
    ];

    public function mount()
    {
        if($this->pageId){
            $page = Page::findOrFail($this->pageId);
            $this->content = $page->content;
            $this->name = $page->name;
            $this->active = $page->active;
        }
    }

    public function store(): void
    {
        $this->authorize('create', Page::class);
        if ($this->resultIcon(Page::create($this->validate()))) {
            $this->reset(['content', 'name', 'active']);
        }
    }

    public function update(): void
    {
        $page = Page::findOrFail($this->pageId);
        $this->authorize('update', $page);
        $this->resultIcon($page->update($this->validate()));
    }

    public function render()
    {
        return view('livewire.admin.pages.create');
    }
}
