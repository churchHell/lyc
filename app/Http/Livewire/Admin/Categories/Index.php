<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    public string $name = '';
    public ?int $editId = null;
    public int $destroyId = 0;

    protected $listeners = ['render'];
    protected array $rules = ['name'=>'required|string'];

    public function store(): void
    {
        $this->authorize('create', Category::class);
        $validated = $this->validate();
        if(Category::create($validated)){
            $this->emitSuccess();
        }
    }

    public function edit(int $id): void
    {
        $category = Category::findOrFail($id);
    }

    public function update(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);
        $validated = $this->validate();
        $this->result(Category::create($validated));
    }

    // public function confirmYes(): void
    // {
    //     $category = Category::findOrFail($this->destroyId);
    //     $this->authorize('delete', $category);
    //     $this->result($category->delete());
    // }

    // public function confirmNo(): void
    // {
    //     $this->destroyId = 0;
    // }

    public function render()
    {
    	$categories = Category::get()->keyBy('id');
        return view('livewire.admin.categories.index', compact('categories'));
    }
}
