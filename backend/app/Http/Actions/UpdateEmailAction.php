<?php
namespace App\Http\Actions;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
class UpdateEmailAction
{
    public static function execute(User $user, string $newEmail)
    {

        if (User::where('email', $newEmail)->exists()) {
            throw new UserAlreadyExistsException();
        }

        $user->email = $newEmail;
        $user->email_verify = 0;
        $user->save();
    }
}
