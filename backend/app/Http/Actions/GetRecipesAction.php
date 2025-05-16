<?php

namespace App\Http\Actions;

use App\Models\Recipe;
use Illuminate\Http\Request;

class GetRecipesAction
{
    public static function execute(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');

            switch ($sortBy) {
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
                case 'date':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'ingredients':
                    $query->orderByRaw('json_array_length(ingredients::json) asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->get();
    }
}
