<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Traits\Crud;
use App\Models\User;
use App\Rules\Phone;
use Livewire\Component;

class Edit extends Component
{

    use Crud;

    protected string $class = User::class;

    public array $user;

    protected function rules(): array
    {
        return [
            'user.name' => 'required|string',
            'user.surname' => 'required|string',
            'user.email' => 'required|email|unique:users,email,'.$this->user['id'].',id',
            'user.phone' => ['required', new Phone],
        ];
    }

    public function update(): void
    {
        $updated = $this->crudUpdate($this->user['id'], $this->validate()['user']);
        if($updated){
            $this->emit('userUpdated');
        }
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
