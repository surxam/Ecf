<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Page d'accueil protégée (index des posts)
Route::get('/', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('posts.index');

// Create post (must come BEFORE /posts/{post} to avoid wildcard matching)
Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

// Vue détaillée d'un post
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('posts.show');

Route::post('/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

// Likes and comments (requires auth)
Route::post('/posts/{post}/like', [LikeController::class, 'store'])
    ->middleware('auth')
    ->name('posts.like');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('posts.comments.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
