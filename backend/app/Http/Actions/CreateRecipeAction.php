<?php
namespace App\Http\Actions;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreateRecipeAction
{
    public static function execute(RecipeRequest $request)
    {
        $user = Auth::user();

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = $image->hashName();
                $path = 'recipes/' . $name;
                Storage::disk('public')->put($path, file_get_contents($image));
                $images[] = Storage::disk('public')->url($path);
            }
        }

        Recipe::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'images' => $images,
        ]);
    }
}
