<?php

namespace App\Http\Controllers;

use App\Http\Actions\ChangePasswordAction;
use App\Http\Actions\UpdateEmailAction;
use App\Http\Actions\UpdateUserAvatarAction;
use App\Http\Actions\UpdateUsernameAction;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\UpdateUsernameRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(Auth::user());
    }
    public function updateUsername(UpdateUsernameRequest $request)
    {
        UpdateUsernameAction::execute(auth()->user(), $request->username);

        return response()->json(['message' => 'Имя успешно обновлено.']);
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        UpdateEmailAction::execute(auth()->user(), $request->email);

        return response()->json(['message' => 'Почта успешно обновлена.']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        ChangePasswordAction::execute(auth()->user(), $request->old_password, $request->new_password);

        return response()->json(['message' => 'Пароль успешно обновлен.']);
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        UpdateUserAvatarAction::execute($request);
        return response()->json(['message' => 'Вы успешно сменили фото профиля']);
    }
}
