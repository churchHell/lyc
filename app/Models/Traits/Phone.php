<?php

namespace App\Models\Traits;

trait Phone
{

    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = $this->sanitizePhone($value);
    }

    public function sanitizePhone(string $phone): string
    {
        return preg_replace('/[^0-9]/', '', $phone);
    }

}