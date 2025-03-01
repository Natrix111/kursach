<?php
namespace App\Http\Actions;

use App\Exceptions\ForbiddenException;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteRecipeAction
{
    public static function execute(Recipe $recipe)
    {
        $user = Auth::user();

        $recipe = Recipe::findOrFail($recipe->id);

        if ($recipe->user_id !== $user->id) {
            throw new ForbiddenException();
        }

        foreach ($recipe->images as $image) {
            $path = str_replace(Storage::disk('public')->url(''), '', $image);
            Storage::disk('public')->delete($path);
        }

        $recipe->delete();
    }
}
