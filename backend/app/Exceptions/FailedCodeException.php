<?php

namespace App\Exceptions;

use Exception;

class FailedCodeException extends Exception
{
    public function __construct()
    {
        parent::__construct('Код подтверждения неверный. Пожалуйста, проверьте и повторите ввод.', 400);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
