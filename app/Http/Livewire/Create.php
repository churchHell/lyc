<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Livewire\Traits\Crud;
use App\Http\Livewire\Traits\RequestTrait;

class Create extends Component
{

    use Crud, RequestTrait;

    public string $class;
    public array $fields;
    public array $types = [];
    public ?array $rules = null;
    public string $size;
    public string $styles = 'space-x-2';

    public function mount(): void
    {
        list($this->styles, $this->size) = Str::of($this->styles)->divideSizes();
    }

    protected function rules()
    {
        $rules = $this->rules ?? $this->getRequestRules();
        $rules = Arr::keys_modify($rules, 'fields.');
        return $rules;
    }

    public function store(): void
    {
        $validated = $this->validate($this->rules())['fields'];
        $model = $this->crudCreate($validated);
        if($model->exists){
            $this->emit('createStored', $model);
        }
    }

    public function render()
    {
        return view('livewire.create');
    }

}
