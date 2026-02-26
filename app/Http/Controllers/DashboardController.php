<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Post::with('user.profile')->latest();

        // Filter posts by department for student, alumni, and department users
        if (in_array($user->role, ['student', 'alumni', 'department'])) {
            $department = $user->profile->department;
            $query->where('department', $department);
        }

        $posts = $query->get();
        
        // Stats for sidebar
        $alumniNetworkCount = \App\Models\User::where('role', 'alumni')->count();
        $studentCount = \App\Models\User::where('role', 'student')->count();
        $totalUsers = $alumniNetworkCount + $studentCount;
        $activeDiscussions = Post::count();

        // Suggested Connections (simple: random alumni excluding self)
        $suggestedConnections = \App\Models\User::where('id', '!=', auth()->id())
            ->where('role', 'alumni')
            ->with('profile')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('dashboard', compact('posts', 'totalUsers', 'activeDiscussions', 'suggestedConnections'));
    }
}
