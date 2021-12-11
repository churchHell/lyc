<?php

namespace App\Exceptions;

use Exception;

class ItemDuplicateException extends Exception
{

    public function __construct(string $message = null)
    {
        parent::__construct($message ?? __('item-duplicate'));
    }

}
