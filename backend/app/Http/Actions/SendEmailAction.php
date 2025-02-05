<?php
namespace App\Http\Actions;

use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Mail;

class SendEmailAction
{
    public static function execute(User $user)
    {
        if($user->email_verify == true)
        {
            throw new HttpResponseException(response()->json(['message' => 'email уже подтвержден']));
        }
        $user->verification_code = random_int(100000, 999999);
        $user->verification_code_created_at = now();
        $user->save();

        Mail::to($user->email)->send(new VerificationMail($user->verification_code));

        return $user;
    }
}
