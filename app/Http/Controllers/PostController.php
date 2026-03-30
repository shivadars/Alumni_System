<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        // Ensure only alumni, department or admin users can access
        if (!in_array(Auth::user()->role, ['alumni', 'department', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Ensure only alumni, department or admin users can create
        if (!in_array(Auth::user()->role, ['alumni', 'department', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:51200', // max 50MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts/images', 'supabase');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('posts/videos', 'supabase');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'department' => (Auth::user()->profile && Auth::user()->profile->department) ? trim(Auth::user()->profile->department) : 'General',
            'image' => $imagePath,
            'video' => $videoPath,
        ]);

        // Determine who gets the notification
        // Admins send to everyone. Others send only to same department users and admins.
        $user = Auth::user();
        if ($user->role === 'admin') {
            $otherUsers = \App\Models\User::where('id', '!=', $user->id)->get();
        } else {
            $department = $user->profile ? $user->profile->department : null;
            $otherUsers = \App\Models\User::where('id', '!=', $user->id)
                ->where(function($q) use ($department) {
                    $q->where('role', 'admin')
                      ->orWhereHas('profile', function($subQuery) use ($department) {
                          $cleanDept = trim(strtolower(explode('(', $department)[0])); // handles 'BBA (or Business Administration)' -> 'bba'
                          $subQuery->whereRaw('LOWER(department) LIKE ?', ["%{$cleanDept}%"]);
                      });
                })->get();
        }

        \Illuminate\Support\Facades\Notification::send($otherUsers, new \App\Notifications\NewPostNotification($user->name, $post->title));

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function destroy(Post $post)
    {
        // Allow deletion if the user is the author OR the user is an admin
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }
}
