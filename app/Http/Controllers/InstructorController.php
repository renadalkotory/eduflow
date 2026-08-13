<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function profile()
    {
        return view('instructor.profile');
    }

    public function createCourse()
    {
        return view('instructor.create-course');
    }

    public function manageCourse()
    {
        return view('instructor.manage-course');
    }

    public function createQuiz()
    {
        return view('instructor.create-quiz');
    }

    public function gradeTests()
    {
        return view('instructor.grade-tests');
    }

    public function students()
    {
        $instructorId = auth()->id();

        $students = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.course_id')
            ->join('users', 'enrollments.student_id', '=', 'users.user_id')
            ->where('courses.instructor_id', $instructorId)
            ->select(
                'users.user_id',
                'users.full_name',
                'users.email',
                'courses.title as course_title',
                'enrollments.enrolled_at'
            )
            ->orderBy('enrollments.enrolled_at', 'desc')
            ->get();

        return view('instructor.students', compact('students'));
    }
}