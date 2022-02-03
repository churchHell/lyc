<?php

namespace App\Http\Livewire\Admin\Promocode;

use App\Models\Promocode;
use Livewire\Component;

class Show extends Component
{

    public Promocode $promocode;

    public function render()
    {
        return view('livewire.admin.promocode.show');
    }
}
