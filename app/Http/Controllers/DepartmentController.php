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
        // Get registered department users
        $departments = User::where('role', 'department')
            ->with('profile')
            ->orderBy('name')
            ->get();

        return view('department.index', compact('departments'));
    }

    /**
     * Display alumni belonging to a specific department.
     */
    public function show($department)
    {
        $alumni = User::where('role', 'alumni')
            ->whereHas('profile', function ($query) use ($department) {
                $query->whereRaw('LOWER(department) = LOWER(?)', [$department]);
            })
            ->with('profile')
            ->get();

        return view('department.show', compact('alumni', 'department'));
    }
}
