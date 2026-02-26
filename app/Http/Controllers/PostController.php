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
        // Ensure only alumni or department users can access
        if (!in_array(Auth::user()->role, ['alumni', 'department'])) {
            abort(403, 'Unauthorized action.');
        }
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Ensure only alumni or department users can create
        if (!in_array(Auth::user()->role, ['alumni', 'department'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'department' => Auth::user()->profile->department,
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }
}
