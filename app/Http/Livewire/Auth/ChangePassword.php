<?php

namespace App\Http\Livewire\Auth;


use App\Http\Livewire\Traits\Crud;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{

    use Crud;

    protected string $class = User::class;

    public string $password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    protected array $rules = [
        'password' => ['required', 'current_password'],
        'new_password' => ['required', 'string', 'confirmed', 'min:8', 'max:50'],
    ];

    public function update(): void
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($validated['new_password']);
        $updated = $this->crudUpdate(auth()->id(), $validated);
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
