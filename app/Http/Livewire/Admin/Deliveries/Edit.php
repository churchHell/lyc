<?php

namespace App\Http\Livewire\Admin\Deliveries;

class Edit extends BaseCrud
{

    public int $deliveryId;

    public function mount(array $delivery): void
    {
        $this->deliveryId = $delivery['id'];
        $this->name = $delivery['name'];
        $this->description = $delivery['description'];
        $this->price = $delivery['price'];
    }

    public function update(): void
    {
        $updated = $this->crudUpdate($this->deliveryId, $this->validate());
        if($updated){
            $this->emit('editClose');
            $this->emit('updated');
        }
    }

    public function render()
    {
        return view('livewire.admin.deliveries.edit');
    }
}
