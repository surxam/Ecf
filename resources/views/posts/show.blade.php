@extends('layouts.app')

@section('title', $post->caption)

@section('content')

<style>
    .container{max-width:800px;margin:40px auto;padding:0 16px}
    .post-card{background:#111;border:1px solid #222;border-radius:8px;overflow:hidden}
    .post-image{width:100%;height:420px;display:block;object-fit:cover;}
    .post-description{padding:12px}
    .comments-section{padding:12px;border-top:1px solid #222}
    .comment{display:flex;gap:12px;margin-bottom:12px}
    .comment-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(45deg,#f09433,#bc1888);display:flex;align-items:center;justify-content:center}
    .comment-content{background:#161616;padding:10px;border-radius:10px}
    .add-comment{display:flex;gap:8px;margin-top:12px}
    .comment-input{flex:1;padding:8px;border-radius:20px;background:#222;border:1px solid #333;color:#fff}
    .post-comment-btn{padding:8px 12px;border-radius:18px;background:#0095f6;border:none;color:#fff}
</style>

    <div class="container">
        <article class="post-card">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
            @endif
            <div class="post-description">
                <strong>{{ $post->user->username ?? $post->user->name ?? 'Auteur' }}</strong>
                <p style="color:#bbb">{{ $post->caption }}</p>
                <small style="color:#777">{{ number_format($post->likes_count ?? 0) }} j'aime • {{ $post->comments_count ?? 0 }} commentaires</small>
            </div>
            <div class="comments-section">
                @foreach($post->comments as $comment)
                    <div class="comment">
                        <div class="comment-avatar">{{ strtoupper(substr($comment->user->name ?? ($comment->user->username ?? 'U'), 0, 1)) }}</div>
                        <div class="comment-content">
                            <div style="font-weight:600">{{ $comment->user->username ?? $comment->user->name }}</div>
                            <div style="color:#ddd">{{ $comment->content }}</div>
                        </div>
                    </div>
                @endforeach
                <form method="POST" action="{{ route('posts.comments.store', $post->id) }}" class="add-comment">
                    @csrf
                    <input name="content" type="text" class="comment-input" placeholder="Ajouter un commentaire...">
                    <button class="post-comment-btn">Publier</button>
                </form>
            </div>
        </article>
    </div>

@endsection