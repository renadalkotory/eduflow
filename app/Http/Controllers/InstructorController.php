<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class InstructorController extends Controller
{
    public function dashboard()
    {
        $instructorId = auth()->id();

        $totalCourses = Course::where('instructor_id', $instructorId)->count();
        $publishedCourses = Course::where('instructor_id', $instructorId)->where('status', 'Published')->count();
        $draftCourses = Course::where('instructor_id', $instructorId)->where('status', 'Draft')->count();
        $totalViews = Course::where('instructor_id', $instructorId)->sum('views');
        $recentCourses = Course::where('instructor_id', $instructorId)->orderBy('created_at', 'desc')->take(5)->get();

        return view('Elearning.instructor.dashboard', compact(
            'totalCourses', 'publishedCourses', 'draftCourses', 'totalViews', 'recentCourses'
        ));
    }
}