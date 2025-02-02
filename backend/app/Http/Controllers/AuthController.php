<?php

namespace App\Http\Controllers;

use App\Http\Actions\LoginUserAction;
use App\Http\Actions\RegisterUserAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $token = RegisterUserAction::execute($request->all());

        return response()->json([
            'message' => 'Вы успешно зарегестрировались!',
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $token = LoginUserAction::execute($credentials);

        return response()->json([
            'user' => auth()->user(),
            'token' => $token
        ]);
    }

}
