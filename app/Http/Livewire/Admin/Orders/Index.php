<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Delivery;
use App\Models\{Order, Status};
use Livewire\Component;

class Index extends Component
{

    public array $filters = ['name' => '', 'phone' => ''];

    public function render()
    {
        $orders = Order::query()
            ->with(['delivery', 'purchases', 'promocodes', 'status'])
            ->where(\DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['name'].'%')
            ->where('phone', 'like', '%'.$this->filters['phone'].'%')
//            ->when(!empty($this->filters['name']), fn($q) => $q->where(\DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['name'].'%'))
            ->latest()
            ->get();
        $statuses = Status::get()->keyBy('id')->toArray();
        $deliveries = Delivery::get()->keyBy('id')->toArray();
        return view('livewire.admin.orders.index', compact('deliveries', 'orders', 'statuses'));
    }
}
