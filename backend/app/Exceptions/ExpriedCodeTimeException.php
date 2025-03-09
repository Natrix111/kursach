<?php

namespace App\Exceptions;

use Exception;

class ExpriedCodeTimeException extends Exception
{
    public function __construct()
    {
        parent::__construct('Время действия кода истекло. Пожалуйста, повторите отправку', 410);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
