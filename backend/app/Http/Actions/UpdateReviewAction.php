<?php
namespace App\Http\Actions;

use App\Exceptions\ForbiddenException;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class UpdateReviewAction
{
    public static function execute(Review $review, $comment)
    {
        if (Auth::id() !== $review->user_id) {
            return response()->json(['message' => 'Нет прав для редактирования'], 403);
        }

        $review->update(['comment' => $comment]);
    }
}
