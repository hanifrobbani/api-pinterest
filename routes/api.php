<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\LikeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/posts', [ApiPostController::class, 'index']);
Route::get('/post/{post}', [ApiPostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [ApiPostController::class, 'store']);
    Route::post('/post/{postId}/like', [LikeController::class, 'toggleLike']);
});


//like
Route::get('/post/{postId}/likes', [LikeController::class, 'getLikes']);

//comment
//menangkap id setiap post yang di akses
Route::post('/post/{post_id}/comment', [App\Http\Controllers\Api\CommentController::class, 'store']);
Route::get('/post/{post_id}/comment', [App\Http\Controllers\Api\CommentController::class, 'index']);
Route::get('/allcomments', [App\Http\Controllers\Api\CommentController::class, 'AllComment']);

//auth api user
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
