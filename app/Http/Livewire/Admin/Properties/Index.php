<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Http\Livewire\BaseComponent;
use App\Models\Property;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    protected $listeners = ['propertyCreated' => 'render'];

    public function delete(int $id): void
    {
        $property = Property::findOrFail($id);
        $this->authorize('delete', $property);
        $this->resultIcon($property->delete());
    }

    public function render()
    {
        $properties = Property::get();
        return view('livewire.admin.properties.index', compact('properties'));
    }
}
