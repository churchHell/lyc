<?php

namespace App\Macroses;

use Illuminate\Database\Eloquent\{Builder, Model};

class BuilderMixin
{

    public function findOrFirst()
    {   
        return function(?int $id = null): ?Model
        {
            $wheres = $this->getQuery()->wheres;
            $find = $this->whereId($id)->first();
            if($find){
                return $find;
            }
            $this->getQuery()->wheres = $wheres;
            return $this->first();
        };
    }

    public function toggle()
    {
        return function (string $col): bool
        {
            return $this->model->update([$col => \DB::raw('NOT '.$col)]);
        };
    }

    public function updateIf()
    {   
        return function (bool $condition = false, array $data = []): bool
        {
            if($condition){
                return $this->model->update($data);
            }
            return false;
        };
    }
    
}