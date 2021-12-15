<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\Traits\Crud;
use App\Models\Delivery;
use App\Models\{Order, Status};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends BaseComponent
{

    use AuthorizesRequests, Crud;

    protected string $class = Order::class;

    public bool $commentEdit = false;
    public array $deliveries = [];
    public array $order;
    public array $statuses = [];

    protected array $rules = [
        'order.delivery_id' => 'required|integer|min:1|exists:deliveries,id'
    ];

    public function mount(Order $orderModel)
    {
        $orderModel->full_name = $orderModel->full_name;
        $orderModel->price = $orderModel->price;
        $orderModel->created = $orderModel->created;
        $this->order = $orderModel->toArray();
        $this->calculateDeliveryPrice();
    }

    public function status(int $id)
    {
        $order = Order::findOrFail($this->order['id']);
        $this->authorize('update', $order);
        $status = Status::findOrFail($id);
        if($this->resultIcon($order->status()->associate($status)->save())){
            $this->order['status'] = $status->toArray();
        }
    }

    public function updateComment(): void
    {
        $order = Order::findOrFail($this->order['id']);
        $this->authorize('update', $order);
        $validated = $this->validate(['order.comment' => 'string']);
        $order->update($validated['order']);
        $this->commentEdit = false;
    }

    public function updatedOrderDeliveryId(): void
    {
        $updated = $this->crudUpdate($this->order['id'], $this->validate()['order']);
        if($updated){
            $this->calculateDeliveryPrice();
        }
    }

    private function calculateDeliveryPrice(): void
    {
        $delivery = new Delivery($this->deliveries[$this->order['delivery_id']]);
        $delivery->setWithDiscount($this->order['price']);
        $this->order['delivery'] =  $delivery->toArray();
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
