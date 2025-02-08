<?php

namespace App\Exceptions;

use Exception;

class FailedLoginException extends Exception
{
    public function __construct()
    {
        parent::__construct('Ошибка авторизации. Проверьте логин и пароль.', 401);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
