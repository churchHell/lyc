<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Delivery;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = [
        'deliveryCreated' => 'render',
        'deliveryDeleted' => 'render',
    ];

    public function render()
    {
        $deliveries = Delivery::get();
        return view('livewire.admin.deliveries.index', compact('deliveries'));
    }
}
