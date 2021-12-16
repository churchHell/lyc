<?php

namespace App\Http\Livewire\Admin\Statuses;

use App\Exceptions\DuplicateException;
use App\Http\Livewire\Traits\Crud;
use App\Models\Status;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{

    use Crud;

    private string $class = Status::class;

    public array $colors = ['gray','red', 'orange',
        'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue',
        'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'];

    public string $name = '';
    public string $color = '';

     protected function rules(): array
     {
        return [
            'name' => 'required|string',
            'color' => ['required', 'string', Rule::in($this->colors)]
        ];
     }

    public function store(): void
    {
        try{
            $status = $this->crudCreate($this->validate());
        } catch(DuplicateException $e) {
            $this->addError('error', $e->getMessage());
            return;
        }
        if($status->exists){
            $this->emit('statusCreated');
            $this->reset(['name', 'color']);
        }
    }

    public function render()
    {
        return view('livewire.admin.statuses.create');
    }
}
