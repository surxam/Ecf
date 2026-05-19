<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    /**
     * Suivre ou ne plus suivre un utilisateur
     */
    public function toggle(User $user): JsonResponse
    {
        $currentUser = auth()->user();

        // Vérifier qu'on ne peut pas se suivre soi-même
        if ($currentUser->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas vous suivre vous-même'
            ], 400);
        }

        // Vérifier si l'utilisateur suit déjà
        $follow = Follow::where('follower_id', $currentUser->id)
            ->where('following_id', $user->id)
            ->first();

        if ($follow) {
            // Unfollow
            $follow->delete();
            $isFollowing = false;
            $message = 'Vous ne suivez plus cet utilisateur';
        } else {
            // Follow
            Follow::create([
                'follower_id' => $currentUser->id,
                'following_id' => $user->id,
            ]);
            $isFollowing = true;
            $message = 'Vous suivez maintenant cet utilisateur';
        }

        // Compter les nouveaux totaux
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        return response()->json([
            'success' => true,
            'isFollowing' => $isFollowing,
            'message' => $message,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
        ]);
    }

    /**
     * Vérifier si l'utilisateur connecté suit un autre utilisateur
     */
    public function checkFollowStatus(User $user): JsonResponse
    {
        $currentUser = auth()->user();
        
        $isFollowing = Follow::where('follower_id', $currentUser->id)
            ->where('following_id', $user->id)
            ->exists();

        return response()->json([
            'isFollowing' => $isFollowing,
        ]);
    }
}
