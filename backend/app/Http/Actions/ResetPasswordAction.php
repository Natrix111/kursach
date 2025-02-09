<?php
namespace App\Http\Actions;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    public static function execute(string $email, string $code, string $password)
    {
        VerifyResetCodeAction::execute($email, $code);

        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new HttpResponseException(response()->json(['message' => 'Пользователь с такой почтой не найден.'], 404));
        }

        $user->password = Hash::make($password);
        $user->save();

        DB::table('password_resets')->where('email', $email)->delete();
    }
}
