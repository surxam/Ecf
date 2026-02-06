<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Redirection vers login si pas authentifié, sinon vers index
Route::get('/', function () {
    return auth()->check() ? redirect('/index') : redirect('/login');
});

// Page d'accueil protégée (index des posts)
Route::get('/index', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('posts.index');

// Vue détaillée d'un post
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('posts.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
