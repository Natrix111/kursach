<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Пользователь с такой почтой уже существует.', 409);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
