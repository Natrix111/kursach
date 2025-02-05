<?php
namespace App\Http\Actions;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterUserAction
{
    public static function execute(array $data)
    {
        if (User::where('email', $data['email'])->exists()) {
            throw new UserAlreadyExistsException();
        }

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return  $token;
    }
}
