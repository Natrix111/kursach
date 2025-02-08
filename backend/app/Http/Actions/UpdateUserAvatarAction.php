<?php
namespace App\Http\Actions;

use App\Exceptions\FailedValidationException;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUserAvatarAction
{
    public static function execute(UpdateAvatarRequest $request)
    {
        $user = Auth::user();

        if($request->hasFile('avatar')) {

            $name = $request->avatar->hashName();
            $path = 'avatars/' . $name;
            Storage::disk('public')->put($path, file_get_contents($request->file('avatar')));
            $photoUrl = Storage::disk('public')->url($path);
            $user->avatar = $photoUrl;
            $user->save();
        }
        else {
            throw new FailedValidationException();
        }
    }
}
