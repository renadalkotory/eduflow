<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display the Student Course Details page.
     */
    public function show(Request $request, int $course)
    {
        $student = Auth::user();

        // Make sure only students can access this page.
        if (!$student || $student->role !== 'student') {
            abort(403, 'Only students can access this page.');
        }

        // Make sure this student is enrolled in this course.
        $enrollment = Enrollment::where('student_id', $student->user_id)
            ->where('course_id', $course)
            ->first();

        if (!$enrollment) {
            abort(403, 'You are not enrolled in this course.');
        }

        // Load the course and all information needed by the
        // Student Course Details page.
        $courseData = Course::with([
            'instructor',
            'category',
            'sections.lessons',
            'sections.files',
            'sections.quizzes',
        ])->findOrFail($course);

        return view('student.course-details', [
            'course' => $courseData,
            'enrollment' => $enrollment,
        ]);
    }
}