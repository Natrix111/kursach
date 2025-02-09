<?php
namespace App\Http\Actions;

use App\Exceptions\ExpriedCodeTimeException;
use App\Exceptions\FailedCodeException;
use App\Mail\PasswordResetMail;
use App\Mail\VerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VerifyResetCodeAction
{
    public static function execute(string $email, string $code)
    {
        $resetRecord = DB::table('password_resets')->where('email', $email)->first();
        if (!$resetRecord || $resetRecord->code !== $code) {
            throw new FailedCodeException();
        }

        if (Carbon::parse($resetRecord->expires_at)->addMinutes(15)->isPast()) {
            DB::table('password_resets')->where('email', $email)->delete();
            throw new ExpriedCodeTimeException();
        }
    }
}
