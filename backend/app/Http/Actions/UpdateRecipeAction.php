<?php
namespace App\Http\Actions;

use App\Exceptions\ForbiddenException;
use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateRecipeAction
{
    public static function execute(RecipeRequest $request, Recipe $recipe)
    {
        $user = Auth::user();

        $recipe = Recipe::findOrFail($recipe->id);

        if ($recipe->user_id !== $user->id) {
            throw new ForbiddenException();
        }

        $recipe->update([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions
        ]);

        if ($request->hasFile('images')) {
            foreach ($recipe->images as $image) {
                $path = str_replace(Storage::disk('public')->url(''), '', $image);
                Storage::disk('public')->delete($path);
            }

            $images = [];
            foreach ($request->file('images') as $image) {
                $name = $image->hashName();
                $path = 'recipes/' . $name;
                Storage::disk('public')->put($path, file_get_contents($image));
                $images[] = Storage::disk('public')->url($path);
            }

            $recipe->images = $images;
        }

        $recipe->save();
    }
}
