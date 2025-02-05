<?php

namespace App\Http\Controllers;

use App\Http\Actions\UpdateUsernameAction;
use App\Http\Requests\UpdateUsernameRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateUsername(UpdateUsernameRequest $request)
    {
        UpdateUsernameAction::execute(auth()->user(), $request->username);

        return response()->json(['message' => 'Имя успешно обновлено.']);
    }
}
