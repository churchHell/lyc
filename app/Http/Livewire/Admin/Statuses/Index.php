<?php

namespace App\Http\Livewire\Admin\Statuses;

use App\Models\Status;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = [
        'statusCreated' => 'render',
        'statusDeleted' => 'render'
    ];

    public function render()
    {
        $statuses = Status::get();
        return view('livewire.admin.statuses.index', compact('statuses'));
    }
}
