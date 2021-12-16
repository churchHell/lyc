<?php

namespace App\Http\Livewire\Admin\Statuses;

use App\Exceptions\NotEmptyException;
use App\Http\Livewire\Traits\Crud;
use App\Models\Status;
use Livewire\Component;

class Show extends Component
{

    use Crud;

    protected string $class = Status::class;

    public array $status;

    public function mount(Status $statusModel): void
    {
        $this->status = $statusModel->toArray();
    }

    public function delete(): void
    {
        try{
            $deleted = $this->crudDelete($this->status['id']);
        }catch(NotEmptyException $e){
            $this->addError('error', $e->getMessage());
            return;
        }
        if($deleted){
            $this->emit('statusDeleted');
        }
    }

    public function render()
    {
        return view('livewire.admin.statuses.show');
    }
}
