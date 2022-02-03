<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Http\Livewire\Traits\Crud;
use App\Http\Livewire\Traits\RequestTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Update extends Component
{

    use Crud, RequestTrait;

    public string $class;
    public Model $model;
    public array $fields;
    public ?array $rules = null;
    public string $styles = 'space-x-2';
    public array $types = [];

    public function mount(): void
    {
        $this->class = get_class($this->model);
        $this->fields = Arr::only($this->model->toArray(), $this->model->getFillable());
        list($this->styles, $this->size) = Str::of($this->styles)->divideSizes();
    }

    protected function rules()
    {
        $rules = $this->rules ?? $this->getRequestRules();
        $rules = Arr::keys_modify($rules, 'fields.');
        dd($rules);
        return $rules;
    }

    public function update(): void
    {
        $validated = $this->validate()['fields'];
        $updated = $this->model->update($validated);
        if ($updated) {
            session()->flush('success', 'Данные успешно обновлены');
            $this->emit('editUpdated');
        }
    }

    public function render()
    {
        return view('livewire.update');
    }
}
