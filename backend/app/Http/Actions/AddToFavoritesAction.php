<?php
namespace App\Http\Actions;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class AddToFavoritesAction
{
    public static function execute(Recipe $recipe)
    {
        $user = Auth::user();

        if (!$user->favoriteRecipes()->where('recipe_id', $recipe->id)->exists()) {
            $user->favoriteRecipes()->attach($recipe->id);
        }
    }
}
