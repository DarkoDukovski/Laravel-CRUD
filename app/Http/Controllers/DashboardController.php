<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\News;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with counts.
     */
    public function index()
    {
        // Count students
        $studentCount = Student::count();

        // Count news
        $totalNewsCount = News::count();

        // Count active news
        $activeNewsCount = News::where('status', true)->count();

        // Count inactive news
        $inactiveNewsCount = News::where('status', false)->count();

        // Return the dashboard view with counts
        return view('auth.dashboard', compact('studentCount', 'totalNewsCount', 'activeNewsCount', 'inactiveNewsCount'));
    }
}