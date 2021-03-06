<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Traits\Crud;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Account extends \App\Http\Livewire\BaseComponent
{

    use Crud;

    protected string $class = User::class;

    public string $name;
    public string $surname;
    public string $phone;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:20'],
    ];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->surname = auth()->user()->surname;
        $this->phone = auth()->user()->phone;
    }

    public function update(): void
    {
        $validated = $this->validate();
        $this->crudUpdate(auth()->id(), $validated);
    }

    public function render()
    {
        return view('livewire.auth.account')->extends('layouts.app');
    }
}
