<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Traits\Crud;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{

    use Crud;

    protected string $class = User::class;

    public array $user;
    public array $roles = [];
    public bool $edit = false;

    protected $listeners = ['userUpdated'];

    protected array $rules = [
        'user.role_id' => 'required|integer|exists:roles,id'
    ];

    public function mount(User $userModel): void
    {
        $userModel->full_name = $userModel->full_name;
        $this->user = $userModel->toArray();
    }

    public function delete(): void
    {
        if($this->crudDelete($this->user['id'])){
            $this->emit('userDeleted');
        }
    }

    public function userUpdated(): void
    {
        $user = User::with('role')->findOrFail($this->user['id']);
        $user->full_name = $user->full_name;
        $this->user = $user->toArray();
        $this->edit = false;
        $this->render();
    }

    public function updatedUserRoleId(): void
    {
        $this->crudUpdate($this->user['id'], $this->validate()['user']);
    }

    public function render()
    {
        return view('livewire.admin.users.show');
    }
}
