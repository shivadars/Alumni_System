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
        // Try to find the department user to get their specific department mapping
        $deptUser = User::where('name', $department)
            ->where('role', 'department')
            ->with('profile')
            ->first();

        if ($deptUser && $deptUser->profile && $deptUser->profile->department) {
            $searchTerm = $deptUser->profile->department;
        } else {
            // Fallback to cleaned name if no profile mapping exists
            $searchTerm = preg_replace('/(_|\s+)?department$/i', '', $department);
        }

        $alumni = User::where('role', 'alumni')
            ->whereHas('profile', function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(department) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            })
            ->with('profile')
            ->get();

        return view('department.show', compact('alumni', 'department'));
    }
}
