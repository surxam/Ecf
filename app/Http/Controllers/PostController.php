<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Affiche la liste des posts (index)
     */
    public function index(): View
    {
        $posts = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();
        
        return view('index', compact('posts'));
    }

    /**
     * Affiche un post spécifique
     */
    public function show(Post $post): View
    {
        $post->load(['user', 'comments.user']);
        $post->loadCount(['likes', 'comments']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show create form
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a new post
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'caption' => ['nullable', 'string', 'max:1000'],
            'hashtags' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $request->user();

        $path = $request->file('image')->store('posts', 'public');

        $caption = $request->input('caption', '');
        if ($request->filled('hashtags')) {
            $caption = trim($caption . ' ' . $request->input('hashtags'));
        }

        Post::create([
            'user_id' => $user->id,
            'image' => $path,
            'caption' => $caption,
        ]);

        return redirect()->route('posts.index');
    }
}
