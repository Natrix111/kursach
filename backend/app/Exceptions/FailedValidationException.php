<?php

namespace App\Exceptions;

use Exception;

class FailedValidationException extends Exception
{
    public function __construct()
    {
        parent::__construct('Неверный формат данных. Пожалуйста, проверьте введенные данные.', 400);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
