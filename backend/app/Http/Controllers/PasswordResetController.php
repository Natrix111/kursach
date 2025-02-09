<?php

namespace App\Http\Controllers;

use App\Http\Actions\ResetPasswordAction;
use App\Http\Actions\SendResetCodeAction;
use App\Http\Actions\VerifyResetCodeAction;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetCodeRequest;
use App\Http\Requests\VerifyResetCodeRequest;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function sendResetCode(SendResetCodeRequest $request)
    {
        SendResetCodeAction::execute($request->email);
        return response()->json(['message' => 'Код для восстановления пароля отправлен.']);
    }

    public function verifyResetCode(VerifyResetCodeRequest $request)
    {
        VerifyResetCodeAction::execute($request->email, $request->code);
        return response()->json(['message' => 'Код подтвержден.']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        ResetPasswordAction::execute($request->email, $request->code, $request->password);
        return response()->json(['message' => 'Вы успешно сменили пароль.']);
    }
}
