<?php

namespace App\Http\Controllers;

use App\Http\Actions\CreateRecipeAction;
use App\Http\Actions\DeleteRecipeAction;
use App\Http\Actions\UpdateRecipeAction;
use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    public function show(Recipe $recipe)
    {
        return response()->json($recipe->load(['reviews.user:id,username,avatar']));
    }

    public function store(RecipeRequest $request)
    {
        CreateRecipeAction::execute($request);
        return response()->json(['message' => 'Рецепт успешно создан'],201);
    }

    public function destroy(Recipe $recipe)
    {
        DeleteRecipeAction::execute($recipe);
        return response()->json(['message' => 'Рецепт успешно удален']);
    }

    public function update(RecipeRequest $request, Recipe $recipe)
    {
        UpdateRecipeAction::execute($request, $recipe);
        return response()->json(['message' => 'Рецепт успешно обновлен']);
    }
}
