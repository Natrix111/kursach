<?php

namespace App\Http\Controllers;

use App\Http\Actions\AddToFavoritesAction;
use App\Http\Actions\DeleteFromFavoritesAction;
use App\Models\Recipe;

class FavoriteRecipeController extends Controller
{
    public function store(Recipe $recipe)
    {
        AddToFavoritesAction::execute($recipe);
        return response()->json(['message' => 'Добавлено в избранное']);
    }

    public function destroy(Recipe $recipe) {
        DeleteFromFavoritesAction::execute($recipe);
        return response()->json(['message' => 'Удалено из избранного']);
    }
}
