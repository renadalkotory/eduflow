<?php

namespace App\Http\Controllers;
use App\Models\Category;
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
    $categories = Category::all();
    return view('instructor.create-course', compact('categories'));
}

public function storeCourse(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,category_id',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:Draft,Published',
        'thumbnail' => 'nullable|image|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('course-thumbnails', 'public');
    }

    Course::create([
        'instructor_id' => auth()->id(),
        'category_id' => $validated['category_id'],
        'title' => $validated['title'],
        'description' => $validated['description'],
        'thumbnail' => $path ? asset('storage/' . $path) : null,
        'price' => $validated['price'],
        'views' => 0,
        'status' => $validated['status'],
    ]);

    return redirect()
        ->route('instructor.dashboard')
        ->with('success', 'Course created successfully!');
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