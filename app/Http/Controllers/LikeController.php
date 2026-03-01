<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, \App\Models\Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            $msg = 'Post unliked.';
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
            $msg = 'Post liked.';
        }

        return back(); // Or return JSON if using AJAX
    }
}
