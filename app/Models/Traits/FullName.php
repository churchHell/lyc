<?php

namespace App\Models\Traits;

use App\Casts\Name;

trait FullName
{



//    public function setNameAttribute($value): void
//    {
//        $this->attributes['name'] = $this->sanitize($value);
//    }
//
//    public function setSurnameAttribute($value): void
//    {
//        $this->attributes['surname'] = $this->sanitize($value);
//    }
//
//    public function setPatronymicAttribute($value): void
//    {
//        $this->attributes['patronymic'] = $this->sanitize($value);
//    }

    public function getFullNameAttribute(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

//    public function sanitize(string $var): string
//    {
//        return Str::title($var);
////        return ucfirst(mb_strtolower($var));
//    }

}