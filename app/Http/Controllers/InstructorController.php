<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Credential;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use App\Models\Section;
use App\Models\Submission;
use Illuminate\Http\Request;

class InstructorController extends Controller
{

    // profile

    public function profile()
    {
        $user = auth()->user();

        return view('instructor.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'professional_title' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
        ]);

        $user->update($data);

        return redirect()
            ->route('instructor.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function storeCredential(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = auth()->id();

        Credential::create($data);

        return redirect()
            ->route('instructor.profile')
            ->with('success', 'Credential added successfully.');
    }


    // creat course

    public function createCourse()
    {
        $categories = Category::orderBy('name')->get();

        return view('instructor.create-course', compact('categories'));
    }

    public function storeCourse(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'detailed_description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'thumbnail_path' => 'nullable|string|max:255',
            'promo_video_url' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'published';

        $course = Course::create($data);

        return redirect()
            ->route('instructor.manageCourse', $course->id)
            ->with('success', 'Course created successfully.');
    }

    public function saveDraft(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'detailed_description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'thumbnail_path' => 'nullable|string|max:255',
            'promo_video_url' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'draft';

        $course = Course::create($data);

        return redirect()
            ->route('instructor.manageCourse', $course->id)
            ->with('success', 'Course saved as draft.');
    }


    //manage course


    public function manageCourse($course = null)
    {
        if ($course) {
            $course = Course::with([
                'sections.lessons',
                'quizzes.questions.options'
            ])->findOrFail($course);
        } else {
            $course = Course::where('user_id', auth()->id())
                ->with(['sections.lessons', 'quizzes.questions.options'])
                ->latest()
                ->first();
        }

        return view('instructor.manage-course', compact('course'));
    }

    public function storeSection(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
            'duration_seconds' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['course_id'] = $course->id;
        $data['status'] = $data['status'] ?? 'draft';

        Section::create($data);

        return back()->with('success', 'Section added successfully.');
    }

    public function storeLesson(Request $request, Section $section)
    {
        $data = $request->validate([
            'quiz_id' => 'nullable|exists:quizzes,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:50',
            'duration_seconds' => 'nullable|integer|min:0',
            'file_size_bytes' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['section_id'] = $section->id;
        $data['type'] = $data['type'] ?? 'video';

        Lesson::create($data);

        return back()->with('success', 'Lesson added successfully.');
    }

    public function deleteSection(Section $section)
    {
        $section->delete();

        return back()->with('success', 'Section deleted successfully.');
    }

    public function deleteLesson(Lesson $lesson)
    {
        $lesson->delete();

        return back()->with('success', 'Lesson deleted successfully.');
    }


    // creatquiz


    public function createQuiz($quiz = null)
    {
        $courses = Course::where('user_id', auth()->id())->get();

        $quizData = null;

        if ($quiz) {
            $quizData = Quiz::with([
                'questions.options'
            ])->findOrFail($quiz);
        }

        return view('instructor.create-quiz', [
            'courses' => $courses,
            'quiz' => $quizData,
        ]);
    }

    public function storeQuiz(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit_minutes' => 'nullable|integer|min:1',
            'passing_score' => 'nullable|integer|min:0|max:100',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'draft';

        $quiz = Quiz::create($data);

        return redirect()
            ->route('instructor.createQuiz', $quiz->id)
            ->with('success', 'Quiz created successfully.');
    }


    // grade test

    public function gradeTests()
    {
        $submissions = Submission::with('quiz')
            ->latest()
            ->get();

        return view('instructor.grade-tests', compact('submissions'));
    }

    public function updateSubmission(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'status' => 'required|string|max:50',
            'feedback' => 'nullable|string',
        ]);

        $submission->update($data);

        return redirect()
            ->route('instructor.gradeTests')
            ->with('success', 'Submission updated successfully.');
    }
}
