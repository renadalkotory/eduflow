<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('course_id', 'desc')->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $instructors = User::where('role', 'instructor')
            ->orderBy('full_name')
            ->get();

        $categories = DB::table('categories')
            ->orderBy('category_name')
            ->get();

        return view('admin.courses.create', compact(
            'instructors',
            'categories'
        ));
    }
    public function edit($course)
{
    $course = Course::where('course_id', $course)->firstOrFail();

    $instructors = User::where('role', 'instructor')
        ->orderBy('full_name')
        ->get();

    $categories = DB::table('categories')
        ->orderBy('category_name')
        ->get();

    return view('admin.courses.edit', compact(
        'course',
        'instructors',
        'categories'
    ));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'instructor_id' => [
                'required',
                'integer',
                'exists:users,user_id'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,category_id'
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpeg,png,webp',
                'max:2048'
            ],
            'status' => ['required', 'in:Draft,Published'],
        ]);
        

        $validated['views'] = 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/courses'),
                $filename
            );

            $validated['thumbnail'] = 'uploads/courses/' . $filename;
        }

        Course::create($validated);
        

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }
        public function update(Request $request, $course)
    {
        $course = Course::where('course_id', $course)->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'instructor_id' => [
                'required',
                'integer',
                'exists:users,user_id'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,category_id'
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpeg,png,webp',
                'max:2048'
            ],
            'status' => ['required', 'in:Draft,Published'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/courses'),
                $filename
            );

            $validated['thumbnail'] = 'uploads/courses/' . $filename;
        } else {
            unset($validated['thumbnail']);
        }

        $course->update($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }
    public function destroy($course)
{
    $course = Course::where('course_id', $course)->firstOrFail();

    if ($course->thumbnail) {
        $thumbnailPath = public_path($course->thumbnail);

        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }
    }

    $course->delete();

    return redirect()
        ->route('admin.courses.index')
        ->with('success', 'Course deleted successfully.');
}
}