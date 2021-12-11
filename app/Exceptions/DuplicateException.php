<?php

namespace App\Exceptions;

use Exception;

class DuplicateException extends Exception
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?? __('duplicate-error'));
    }
}
