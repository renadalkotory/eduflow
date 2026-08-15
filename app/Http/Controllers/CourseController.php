<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load('category', 'instructor');
        return view('Elearning.coursedetails', compact('course'));
    }
}