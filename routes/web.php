<?php

use App\Http\Controllers\AllPostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::resource('/posts', PostController::class)->middleware('auth');
// Route::get('/posts', [PostController::class, 'index']); 
// Route::get('/post/{post}', [PostController::class, 'show']);

Route::resource('/admin/posts', AllPostController::class)->middleware('IsAdmin');

//comment
Route::resource('/admin/comments', CommentController::class)->middleware('IsAdmin');
Route::post('/admin/comments/allow/{id}', [CommentController::class, 'allowComment'])->name('admin.comments.allow')->middleware('IsAdmin');
