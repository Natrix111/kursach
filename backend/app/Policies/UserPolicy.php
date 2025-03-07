<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function confirmed(User $user): Response
    {
        return $user->email_verify == 1
            ? Response::allow()
            : Response::deny('Недоступно! Подтвердите почту!',403);
    }
}
