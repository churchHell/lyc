<?php

namespace App\Http\Livewire\Admin\Units;

use App\Exceptions\NotEmptyException;
use App\Http\Livewire\BaseComponent;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    protected $listeners = ['unitCreated' => 'render'];

    public function delete(int $id)
    {
        $unit = Unit::findOrFail($id);
        $this->authorize('delete', $unit);
        try{
            $this->result($unit->delete());
        } catch(NotEmptyException $e){
            $this->addError('error-'.$id, $e->getMessage());
        }
    }

    public function render()
    {
        $units = Unit::get();
        return view('livewire.admin.units.index', compact('units'));
    }
}
