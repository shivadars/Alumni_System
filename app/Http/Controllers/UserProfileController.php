<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        $user = Auth::user();

        // If user already has a profile, redirect to edit or dashboard
        if ($user->profile) {
            return redirect()->route('dashboard');
        }

        return view('profile.setup', compact('user'));
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Automatically prepend https:// if missing for better UX
        if ($request->has('linkedin_url') && $request->linkedin_url) {
            $url = $request->linkedin_url;
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $request->merge(['linkedin_url' => "https://" . $url]);
            }
        }

        $request->validate([
            'department' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'year' => 'nullable|required_if:role,student|string|max:4',
            'graduation_year' => 'nullable|required_if:role,alumni|string|max:4',
            'roll_number' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:7168',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $data = [
            'department' => $request->department,
            'bio' => $request->bio,
            'skills' => $request->skills,
            'year' => $request->year,
            'graduation_year' => $request->graduation_year,
            'roll_number' => $request->roll_number,
            'company' => $request->company,
            'phone' => $request->phone,
            'linkedin_url' => $request->linkedin_url,
            'location' => $request->location,
        ];

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }

        // Check if profile exists to update, else create
        $user->profile()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->route('dashboard')->with('status', 'Profile updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user = null)
    {
        $user = $user ?: Auth::user();
        
        if (!$user->profile) {
            if (Auth::id() === $user->id) {
                return redirect()->route('profile.create')->with('error', 'Please complete your profile first.');
            }
            return redirect()->route('dashboard')->with('error', 'User profile not found.');
        }

        $posts = $user->posts()->with(['user.profile', 'comments.user.profile', 'likes'])->latest()->get();

        return view('profile.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.create');
        }

        return view('profile.setup', compact('user', 'profile'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->store($request);
    }
}
