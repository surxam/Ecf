<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileShowController extends Controller
{
    /**
     * Afficher le profil d'un utilisateur spécifique
     */
    public function show(User $user): View
    {
        // Charger les relations nécessaires
        $user->load(['posts' => function($query) {
            $query->withCount(['likes', 'comments'])
                  ->orderBy('created_at', 'desc')
                  ->take(12);
        }]);
        
        $posts = $user->posts;
        $followers = $user->followers()->take(8)->get();
        $following = $user->following()->take(8)->get();
        
        // Vérifier si l'utilisateur actuel suit cet utilisateur
        $isFollowing = false;
        if (auth()->check()) {
            $isFollowing = auth()->user()->following()->where('following_id', $user->id)->exists();
        }
        
        return view('profiles.show', [
            'user' => $user,
            'posts' => $posts,
            'followers' => $followers,
            'following' => $following,
            'isFollowing' => $isFollowing
        ]);
    }
}
