<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $stats = [
            'schools' => \App\Models\School::count(),
            'teachers' => \App\Models\Teacher::count(),
            'students' => \App\Models\Student::count(),
            'classes' => \App\Models\ClassRoom::count(),
            'assignments' => \App\Models\TeachingAssignment::count(),
        ];

        $recentAssignments = \App\Models\TeachingAssignment::with(['teacher.user', 'classRoom', 'subject'])
            ->latest()
            ->take(5)
            ->get();

        return view('backend.dashboard.index', compact('stats', 'recentAssignments'));
    }
}