<?php

namespace App\Models\Traits;

use App\Casts\Name;

trait FullName
{

    public function getFullNameAttribute(): string
    {
        return $this->surname 
            . ' ' 
            . $this->name 
            . (!empty($this->patronymic) ? ' ' . $this->patronymic : '');
    }

}