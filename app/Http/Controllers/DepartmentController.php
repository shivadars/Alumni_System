<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a list of all unique departments.
     */
    public function index()
    {
        // Get unique departments from profiles of alumni users
        $departments = Profile::whereHas('user', function ($query) {
                $query->where('role', 'alumni');
            })
            ->whereNotNull('department')
            ->distinct()
            ->pluck('department');

        return view('department.index', compact('departments'));
    }

    /**
     * Display alumni belonging to a specific department.
     */
    public function show($department)
    {
        $alumni = User::where('role', 'alumni')
            ->whereHas('profile', function ($query) use ($department) {
                $query->where('department', $department);
            })
            ->with('profile')
            ->get();

        return view('department.show', compact('alumni', 'department'));
    }
}
