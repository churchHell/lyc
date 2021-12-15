<?php 

namespace App\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait Crud 
{

    use AuthorizesRequests;

    public function crudActivate(int $id): Model
    {
        $model = $this->getModelWithAuthorize('update', $id);
        $model->activeToggle();
        $model = $model->fresh();
        return $model;
    }

    public function crudCreate(array $data): Model
    {
        $this->authorize('create', $this->class);
        $model = app()->make($this->class)->create($data);
        return $model;
    }    

    public function crudDelete(int $id): bool
    {
        $model = $this->getModelWithAuthorize('delete', $id);
        return $model->delete();
    }

    public function crudUpdate(int $id, array $data = []): bool
    {
        $model = $this->getModelWithAuthorize('update', $id);
        return $model->update($data);
    }

    public function getModelWithAuthorize(string $action, int $id): Model
    {
        $model = app()->make($this->class)->findOrFail($id);
        $this->authorize($action, $model);
        return $model;
    }

}