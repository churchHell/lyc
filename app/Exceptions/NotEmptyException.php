<?php

namespace App\Exceptions;

use Exception;

class NotEmptyException extends Exception
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?? __('not-empty'));
    }
}
