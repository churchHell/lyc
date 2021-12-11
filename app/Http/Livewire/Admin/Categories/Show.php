<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Exceptions\NotEmptyException;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Show extends Component
{

    use AuthorizesRequests;

    public array $category = [];
    public bool $destroy = false;
    public bool $edit = false;
    public string $name = '';

    protected array $rules = ['name' => 'required|string'];

    protected $listeners = ['confirmYes', 'confirmNo'];

    public function mount(Category $categoryModel): void
    {
        $this->category = $categoryModel->toArray();
        $this->name = $categoryModel->name;
    }

    public function update(): void
    {
        $category = Category::findOrFail($this->category['id']);
        $this->authorize('update', $category);
        if($category->update($this->validate())){
            $this->edit = false;
            $this->category = Category::findOrFail($this->category['id'])->toArray();
            $this->render();
        }
    }

    public function activate(): void
    {
        $category = Category::findOrFail($this->category['id']);
        $this->authorize('update', $category);
        if($category->activeToggle()){
            $this->category['active'] = !$this->category['active'];
        }
    }

    public function confirmYes(): void
    {
        $category = Category::findOrFail($this->category['id']);
        $this->authorize('delete', $category);
        try{
            if($category->delete()){
                $this->emitUp('render');
            }
        } catch(NotEmptyException $e){
            $this->addError('error', $e->getMessage());
        }
    }

    public function confirmNo(): void
    {
        $this->destroy = false;
    }

    public function render()
    {
        return view('livewire.admin.categories.show');
    }
}
