<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Post::with(['user.profile', 'comments.user.profile'])->latest();
        $department = null;

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter posts: show dept-specific posts OR any admin posts
        if (in_array($user->role, ['student', 'alumni', 'department'])) {
            $department = $user->profile->department;
            $query->where(function ($q) use ($department) {
                $q->whereRaw('LOWER(department) LIKE ?', ['%' . strtolower($department) . '%'])
                  ->orWhereHas('user', function ($u) {
                      $u->where('role', 'admin');
                  });
            });
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

        // Trending Topics (Top 5 post categories)
        $trendingTopics = Post::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('category');

        return view('dashboard', compact('posts', 'totalUsers', 'activeDiscussions', 'suggestedConnections', 'department', 'trendingTopics'));
    }
}
