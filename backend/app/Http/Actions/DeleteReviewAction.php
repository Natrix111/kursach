<?php
namespace App\Http\Actions;

use App\Exceptions\ForbiddenException;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DeleteReviewAction
{
    public static function execute(Review $review)
    {
        $user = Auth::user();

        $review = Review::findOrFail($review->id);

        if ($review->user_id !== $user->id) {
            throw new ForbiddenException();
        }

        $review->delete();
    }
}
