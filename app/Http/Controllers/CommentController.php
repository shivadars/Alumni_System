<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->expectsJson()) {
            $comment->load('user.profile');
            return response()->json([
                'comment' => array_merge($comment->toArray(), [
                    'created_at_human' => $comment->created_at->diffForHumans(),
                    'user' => $comment->user
                ]),
                'message' => 'Comment added successfully.'
            ]);
        }

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Request $request, \App\Models\Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $comment->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Comment deleted successfully.']);
        }

        return back()->with('success', 'Comment deleted successfully.');
    }
}
