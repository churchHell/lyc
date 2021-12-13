<?php

namespace App\Http\Livewire\Admin\Deliveries;

class Create extends BaseCrud
{    

    public function store(): void
    {
        if($this->crudCreate($this->validate())->exists){
            $this->emit('deliveryCreated');
            $this->reset(['description', 'name', 'price']);
        }
        
    }

    public function render()
    {
        return view('livewire.admin.deliveries.create');
    }
}
