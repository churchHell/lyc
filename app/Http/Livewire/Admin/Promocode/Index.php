<?php

namespace App\Http\Livewire\Admin\Promocode;

use App\Models\Promocode;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {        
        $promocodes = Promocode::all();
        return view('livewire.admin.promocode.index', compact('promocodes'));
    }
}
