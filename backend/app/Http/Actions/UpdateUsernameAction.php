<?php
namespace App\Http\Actions;

use App\Models\User;

class UpdateUsernameAction
{
    public static function execute(User $user, string $username)
    {
        $user->username = $username;
        $user->save();
    }
}
