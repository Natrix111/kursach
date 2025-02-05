<?php
namespace App\Http\Actions;


use App\Exceptions\ExpriedCodeTimeException;
use App\Exceptions\FailedCodeException;
use App\Models\User;

class VerifyEmailAction
{
    public static function execute(User $user, $verification_code)
    {
        if($user->verification_code != $verification_code) {
            throw new FailedCodeException();
        }
        if($user->verification_code_created_at->addMinutes(15)->isPast())
        {
            $user->verification_code_created_at = null;
            $user->verification_code = null;
            $user->save();
            throw new ExpriedCodeTimeException();
        }
        $user->email_verify = 1;
        $user->verification_code = null;
        $user->save();
        return $user;
    }
}
