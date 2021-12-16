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

    public string $password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

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

    public function changePassword(): void
    {
        $this->validate([
            'password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'confirmed', 'min:8', 'max:50'],
        ]);

        $this->queryWithResult( fn() => auth()->user()->update(['password' => Hash::make($this->new_password)]) );
    }

    public function render()
    {
        return view('livewire.auth.account')->extends('layouts.app');
    }
}
