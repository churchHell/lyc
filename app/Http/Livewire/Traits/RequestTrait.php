<?php

namespace App\Http\Livewire\Traits;

trait RequestTrait
{

    public function getRequestRules(): array
    {
        $model = ucfirst(class_basename($this->class));
        $action = ucfirst(class_basename(__CLASS__));
        $request = '\App\Http\Requests\\'.$model.$action.'Request';
        if(!class_exists($request)){
            return [];
        }
        return (new $request(1))->rules();
    }

}
