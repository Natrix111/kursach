<?php
namespace App\Http\Actions;

use App\Exceptions\FailedLoginException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginUserAction
{
    public static function execute(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new FailedLoginException();
        }

        return $token;
    }
}
