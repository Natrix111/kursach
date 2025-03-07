<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FavoriteRecipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/asd', function () {
    return 'asd123';
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::patch('/update/username', [ProfileController::class, 'updateUsername']);
    Route::patch('/update/email', [ProfileController::class, 'updateEmail']);
    Route::post('/update/avatar', [ProfileController::class, 'updateAvatar']);
    Route::patch('/change/password', [ProfileController::class, 'changePassword']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/send-email', [EmailVerificationController::class, 'sendEmail']);
    Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);
});

Route::prefix('recipes')->group(function () {
    Route::get('{recipe}', [RecipeController::class, 'show']);
    Route::get('/', [RecipeController::class, 'index']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/', [RecipeController::class, 'store']);
        Route::delete('{recipe}', [RecipeController::class, 'destroy']);
        Route::post('{recipe}', [RecipeController::class, 'update']);
        Route::prefix('favorites')->group(function () {
            Route::post('/{recipe}', [FavoriteRecipeController::class, 'store']);
            Route::delete('/{recipe}', [FavoriteRecipeController::class, 'destroy']);
        });
    });
});

Route::middleware('auth:api')->prefix('reviews')->group(function () {
    Route::post('/', [ReviewController::class, 'store']);
    Route::delete('{review}', [ReviewController::class, 'destroy']);
    Route::put('{review}', [ReviewController::class, 'update']);
});

