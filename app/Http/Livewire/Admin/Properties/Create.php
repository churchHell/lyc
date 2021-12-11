<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Exceptions\DuplicateException;
use App\Http\Livewire\BaseComponent;
use App\Models\Property;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends BaseComponent
{

    use AuthorizesRequests;

    public string $name = '';
    public ?string $unit_id = null;

    protected array $rules = ['name' => ['required', 'string'], 'unit_id' => ['required', 'integer']];

    public function store()
    {
        $this->authorize('create', Property::class);
        $validated = $this->validate();
        try {
            Property::create($validated);
        } catch (DuplicateException $e){
            $this->addError('stored', $e->getMessage());
        }
        $this->emit('propertyCreated');
    }

    public function render()
    {
        $units = Unit::get();
        return view('livewire.admin.properties.create', compact('units'));
    }
}
