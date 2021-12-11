<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\{Order, Status};
use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends BaseComponent
{

    use AuthorizesRequests;

    public bool $commentEdit = false;
    public array $order;
    public array $statuses;

    public function mount(Order $orderModel, array $allStatuses)
    {
        $orderModel->full_name = $orderModel->full_name;
        $orderModel->price = $orderModel->price;
        $this->order = $orderModel->toArray();
        $this->statuses = $allStatuses;
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

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
