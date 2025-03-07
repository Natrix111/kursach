<?php

namespace App\Http\Controllers;

use App\Http\Actions\DeleteReviewAction;
use App\Http\Actions\UpdateReviewAction;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        Gate::authorize('confirmed', auth()->user());
        Review::create([
            'recipe_id' => $request->recipe_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Отзыв успешно создан!'], 201);
    }

    public function destroy(Review $review)
    {
        Gate::authorize('confirmed', auth()->user());
        DeleteReviewAction::execute($review);
        return response()->json(['message' => 'Отзыв удален!']);
    }

    public function update(Review $review, UpdateReviewRequest $request)
    {
        Gate::authorize('confirmed', auth()->user());
        UpdateReviewAction::execute($review, $request->comment);
        return response()->json(['message' => 'Отзыв обновлен!']);
    }
}
