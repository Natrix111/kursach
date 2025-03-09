<?php

namespace App\Http\Controllers;

use App\Http\Actions\SendEmailAction;
use App\Http\Actions\VerifyEmailAction;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendEmail()
    {
        SendEmailAction::execute(auth()->user());
        return response()->json(['message' => 'Код отправлен']);
    }

    public function verifyEmail(Request $request)
    {
        VerifyEmailAction::execute(auth()->user(), $request->verification_code);
        return response()->json(['message' => 'Почта подтверждена']);
    }
}
