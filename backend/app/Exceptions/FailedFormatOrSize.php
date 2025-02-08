<?php

namespace App\Exceptions;

use Exception;

class FailedFormatOrSize extends Exception
{
    public function __construct()
    {
        parent::__construct('Недопустимый формат или размер изображения(Загрузите файл не более 2МБ и формата png,jpg,jpeg)', 413);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
