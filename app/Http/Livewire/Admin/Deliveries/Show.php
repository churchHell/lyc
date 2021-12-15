<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Http\Livewire\Traits\Crud;
use App\Models\Delivery;
use Livewire\Component;

class Show extends Component
{

    use Crud;

    protected string $class = Delivery::class;

    public array $delivery;
    public bool $edit = false;

    protected $listeners = ['editClose', 'updated'];

    public function mount(Delivery $deliveryModel)
    {
        $this->delivery = $deliveryModel->toArray();
    }

    public function editClose(): void
    {
        $this->edit = false;
    }

    public function activate(): void
    {
        $delivery = $this->crudActivate($this->delivery['id']);
        $this->delivery['active'] = $delivery->active;
    }

    public function activateFreePrice(): void
    {
        $delivery = $this->getModelWithAuthorize('update', $this->delivery['id']);
        if($delivery->toggle('active_free_price')){
            $this->delivery['active_free_price'] = $delivery->fresh()->active_free_price;
        }
    }

    public function delete(): void
    {
        $result = $this->crudDelete($this->delivery['id']);
        if($result){
            $this->emit('deliveryDeleted');
        }
    }

    public function updated(): void
    {
        $this->delivery = Delivery::findOrFail($this->delivery['id'])->toArray();
    }

    public function render()
    {
        return view('livewire.admin.deliveries.show');
    }
}
