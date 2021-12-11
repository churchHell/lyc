<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public string $template = '';
    public array $data = [];

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.modal');
    }
}
