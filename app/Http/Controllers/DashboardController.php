<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
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
            $department = $user->profile->department ?? 'General';
            $query->where(function ($q) use ($department, $user) {
                $q->whereRaw('LOWER(department) LIKE ?', ['%' . strtolower($department) . '%'])
                  ->orWhereHas('user', function ($u) {
                      $u->where('role', 'admin');
                  })
                  ->orWhere('user_id', $user->id);
            });
        }

        $posts = $query->paginate(10);
        
        // Stats for sidebar (Cached for 10 mins)
        $stats = \Cache::remember('dashboard_stats', 600, function() {
            $alumniNetworkCount = \App\Models\User::where('role', 'alumni')->count();
            $studentCount = \App\Models\User::where('role', 'student')->count();
            $activeDiscussions = \App\Models\Post::count();
            return [
                'totalUsers' => $alumniNetworkCount + $studentCount,
                'activeDiscussions' => $activeDiscussions
            ];
        });

        $totalUsers = $stats['totalUsers'];
        $activeDiscussions = $stats['activeDiscussions'];

        // Suggested Connections (simple: random alumni excluding self - limited selection to avoid heavy scan)
        $suggestedConnections = \App\Models\User::where('id', '!=', auth()->id())
            ->where('role', 'alumni')
            ->with('profile')
            ->whereIn('id', function($q) {
                $q->select('id')->from('users')->where('role', 'alumni')->limit(50);
            })
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Trending Topics (Top 5 post categories)
        $trendingTopics = Post::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('category');

        // Get featured upcoming event
        $featuredEvent = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->first();

        return view('dashboard', compact('posts', 'totalUsers', 'activeDiscussions', 'suggestedConnections', 'department', 'trendingTopics', 'featuredEvent'));
    }
}
