<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Affiche la liste des posts (index)
     */
    public function index(): View
    {
        $posts = Post::with('user', 'likes')->latest()->get();
        
        return view('index', compact('posts'));
    }

    /**
     * Affiche un post spécifique
     */
    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }
}
