<?php
namespace App\Http\Actions;

use App\Mail\PasswordResetMail;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendResetCodeAction
{
    public static function execute(string $email)
    {
        $user = User::where('email', $email)->where('email_verify', true)->first();
        if (!$user) {
            throw new HttpResponseException(response()->json(['message' => 'Пользователь с такой почтой не найден или не верифицирован.'], 404));
        }

        $resetCode = random_int(100000, 999999);
        $expiresAt = now();

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['code' => $resetCode, 'expires_at' => $expiresAt]
        );

        Mail::to($email)->send(new PasswordResetMail($resetCode));
    }
}
