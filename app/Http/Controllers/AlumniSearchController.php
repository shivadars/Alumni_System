<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AlumniSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('role', 'alumni')->with('profile');

        // Search by Name (User table)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Search by Profile fields
        $query->whereHas('profile', function ($q) use ($request) {
            if ($request->filled('department')) {
                $q->where('department', 'like', '%' . $request->department . '%');
            }
            if ($request->filled('graduation_year')) {
                $q->where('graduation_year', $request->graduation_year);
            }
            if ($request->filled('company')) {
                $q->where('company', 'like', '%' . $request->company . '%');
            }
        });

        $alumni = $query->paginate(12)->withQueryString();

        $graduationYears = \App\Models\Profile::whereNotNull('graduation_year')
            ->distinct()
            ->orderBy('graduation_year', 'desc')
            ->pluck('graduation_year');

        return view('alumni.index', compact('alumni', 'graduationYears'));
    }
}
