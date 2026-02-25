<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::with('profile')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Approve an alumni user.
     */
    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('success', "User {$user->name} has been approved.");
    }

    /**
     * Reject an alumni user.
     */
    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', "User {$user->name} has been rejected.");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        return back()->with('success', "User {$name} has been deleted.");
    }
}
