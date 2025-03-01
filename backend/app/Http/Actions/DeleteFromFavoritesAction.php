<?php
namespace App\Http\Actions;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DeleteFromFavoritesAction
{
    public static function execute(Recipe $recipe)
    {
        Auth::user()->favoriteRecipes()->detach($recipe->id);
    }
}
