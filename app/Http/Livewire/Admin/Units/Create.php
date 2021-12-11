<?php

namespace App\Http\Livewire\Admin\Units;

use App\Exceptions\DuplicateException;
use App\Http\Livewire\BaseComponent;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends BaseComponent
{

    use AuthorizesRequests;

    public string $name = '';

    protected array $rules = ['name' => ['required', 'string']];

    public function store(): void
    {
        $this->authorize('create', Unit::class);
        $validated = $this->validate();
        try {
            Unit::create($validated);
        } catch (DuplicateException $e){
            $this->addError('stored', $e->getMessage());
        }
        $this->emit('unitCreated');
    }

    public function render()
    {
        $units = Unit::get();
        return view('livewire.admin.units.create', compact('units'));
    }
}
