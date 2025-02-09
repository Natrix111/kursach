<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/', [AuthController::class, 'me']);
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

Route::prefix('password')->group(function () {
    Route::post('request-reset', [PasswordResetController::class, 'sendResetCode']);

    Route::post('verify-reset-code', [PasswordResetController::class, 'verifyResetCode']);

    Route::post('reset', [PasswordResetController::class, 'resetPassword']);
});
