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
        $model = $newModel->fresh();
        $this->crudEmitResult($newModel->activate != $model->active);
        return $newModel;
    }

    public function crudCreate(array $data): Model
    {
        $this->authorize('create', $this->class);
        $model = app()->make($this->class)->create($data);
        $this->crudEmitResult($model->exists);
        return $model;
    }    

    public function crudDelete(int $id): bool
    {
        $model = $this->getModelWithAuthorize('delete', $id);
        $deleted = $model->delete();
        $this->crudEmitResult($deleted);
        return $deleted;
    }

    public function crudUpdate(int $id, array $data = []): bool
    {
        $model = $this->getModelWithAuthorize('update', $id);
        $updated = $model->update($data);
        $this->crudEmitResult($updated);
        return $updated;
    }

    public function getModelWithAuthorize(string $action, int $id): Model
    {
        $model = app()->make($this->class)->findOrFail($id);
        $this->authorize($action, $model);
        return $model;
    }

    private function crudEmitResult(bool $condition): void
    {
        $this->emit($condition ? 'success' : 'error');
    }

}