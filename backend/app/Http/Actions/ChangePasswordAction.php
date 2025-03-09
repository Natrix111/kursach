<?php
namespace App\Http\Actions;

use App\Exceptions\InvalidOldPasswordException;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    public static function execute(User $user, string $oldPassword, string $newPassword)
    {
        if (!Hash::check($oldPassword, $user->password)) {
            throw new InvalidOldPasswordException();
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }
}
