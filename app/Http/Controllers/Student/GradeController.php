<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Display the Student Grades page.
     */
    public function index()
    {
        $student = Auth::user();

        // Only students can access the Grades page.
        if (!$student || $student->role !== 'student') {
            abort(403, 'Only students can access this page.');
        }

        // Get this student's quiz attempts.
        $attempts = QuizAttempt::with([
            'quiz.section.course',
        ])
        ->where('student_id', $student->user_id)
        ->orderByDesc('attempt_date')
        ->get();

        return view('student.grades', [
            'attempts' => $attempts,
        ]);
    }
}