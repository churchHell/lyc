<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public array $roles = [];

    public function mount(): void
    {
        $this->roles = Role::get()->toArray();
    }

    protected $listeners = ['userDeleted' => 'render'];

    public function render()
    {
        $users = User::with('role')->latest()->orderBy('role_id')->get();
        return view('livewire.admin.users.index', compact('users'));
    }
}
