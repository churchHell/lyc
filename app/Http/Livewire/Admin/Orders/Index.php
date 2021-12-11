<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\{Order, Status};
use Livewire\Component;

class Index extends Component
{

    public array $filters = ['name' => '', 'phone' => ''];

    public function render()
    {
        $orders = Order::query()
            ->with(['delivery', 'purchases', 'status'])
            ->where(\DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['name'].'%')
            ->where('phone', 'like', '%'.$this->filters['phone'].'%')
//            ->when(!empty($this->filters['name']), fn($q) => $q->where(\DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['name'].'%'))
            ->get();
        $statuses = Status::get()->keyBy('id');
        return view('livewire.admin.orders.index', compact('orders', 'statuses'));
    }
}
