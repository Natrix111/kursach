<?php
namespace App\Http\Actions;

use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginUserAction
{
    public static function execute(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный email или пароль.'],
            ]);
        }

        return $token;
    }
}
