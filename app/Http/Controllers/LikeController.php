<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, \App\Models\Post $post)
    {
        $liked = $post->likes()->where('user_id', auth()->id())->exists();

        if ($liked) {
            $post->likes()->where('user_id', auth()->id())->delete();
            $msg = 'Post unliked.';
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
            $msg = 'Post liked.';
            $liked = true;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $post->likes()->count(),
                'message' => $msg,
            ]);
        }

        return back();
    }
}
