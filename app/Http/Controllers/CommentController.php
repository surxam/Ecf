<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        return back();
    }
}
