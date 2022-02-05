<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Crud;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Delete extends Component
{

    use Crud;

    public Model $model;

    public bool $confirm = false;

    protected $listeners = ['confirmYes', 'confirmNo'];

    public function delete(): void
    {
        $this->confirm = true;
    }

    public function confirmYes(): void
    {
        $deleted = $this->model->delete();
        if ($deleted) {
            $this->emit('deleteDeleted');
        }
    }

    public function confirmNo(): void
    {
        $this->confirm = false;
    }

    public function render()
    {
        return view('livewire.delete');
    }
}
