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
            $imagePath = $request->file('image')->store('posts/images', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('posts/videos', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'department' => Auth::user()->profile ? Auth::user()->profile->department : null,
            'image' => $imagePath,
            'video' => $videoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }
}
