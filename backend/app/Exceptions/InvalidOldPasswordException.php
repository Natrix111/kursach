<?php

namespace App\Exceptions;

use Exception;

class InvalidOldPasswordException extends Exception
{
    public function __construct()
    {
        parent::__construct('Старый пароль неверный. Пожалуйста, проверьте введенные данные.', 422);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
