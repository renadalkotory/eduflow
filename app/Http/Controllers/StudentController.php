<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // =========================
    // Dashboard
    // =========================
public function dashboard()
{
    $studentId = Auth::id();

    // Get logged-in student
    $student = DB::table('users')
        ->where('user_id', $studentId)
        ->first();

    // Get student's enrolled courses
    $courses = DB::table('enrollments')
        ->join(
            'courses',
            'enrollments.course_id',
            '=',
            'courses.course_id'
        )
        ->where('enrollments.student_id', $studentId)
        ->select(
            'courses.course_id',
            'courses.title',
            'courses.description',
            'courses.thumbnail'
        )
        ->get();

    // Calculate progress for each course
    foreach ($courses as $course) {

        // Total lessons
        $totalLessons = DB::table('lessons')
            ->join(
                'sections',
                'lessons.section_id',
                '=',
                'sections.section_id'
            )
            ->where('sections.course_id', $course->course_id)
            ->count();

        // Completed lessons by this student
        $completedLessons = DB::table('course_progress')
            ->join(
                'lessons',
                'course_progress.lesson_id',
                '=',
                'lessons.lesson_id'
            )
            ->join(
                'sections',
                'lessons.section_id',
                '=',
                'sections.section_id'
            )
            ->where('sections.course_id', $course->course_id)
            ->where('course_progress.student_id', $studentId)
            ->where('course_progress.completed', 1)
            ->count();

        $course->totalLessons = $totalLessons;
        $course->completedLessons = $completedLessons;

        // Progress percentage
        $course->progress = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100)
            : 0;

        // Status
        $course->status = ($totalLessons > 0 && $completedLessons == $totalLessons)
            ? 'completed'
            : 'in_progress';
    }

    // Statistics
    $coursesInProgress = $courses
        ->where('status', 'in_progress')
        ->count();

    $completedCourses = $courses
        ->where('status', 'completed')
        ->count();

    // Average quiz grade
    $averageGrade = DB::table('quiz_results')
        ->where('student_id', $studentId)
        ->avg('percentage');

    $averageGrade = $averageGrade
        ? round($averageGrade, 2)
        : 0;

    // Most recent quiz
    $recentQuiz = DB::table('quiz_results')
        ->join(
            'quizzes',
            'quiz_results.quiz_id',
            '=',
            'quizzes.quiz_id'
        )
        ->where('quiz_results.student_id', $studentId)
        ->select(
            'quiz_results.created_at',
            'quiz_results.percentage',
            'quizzes.title'
        )
        ->orderBy('quiz_results.created_at', 'desc')
        ->first();

    return view('student.dashboard', compact(
        'student',
        'courses',
        'coursesInProgress',
        'completedCourses',
        'averageGrade',
        'recentQuiz'
    ));
}

    // =========================
    // Profile
    // =========================
     public function profile()
    {
        $studentId = Auth::id();

         $student = DB::table('users')
            ->where('user_id', $studentId)
            ->first();

        if (!$student) {
            abort(404);
        }

        return view('student.profile', compact('student'));
    }


    // =========================
    // My Courses
    // =========================
    public function courses()
    {
        $studentId = Auth::id();

        $courses = DB::table('enrollments')
            ->join(
                'courses',
                'enrollments.course_id',
                '=',
                'courses.course_id'
            )
            ->where('enrollments.student_id', $studentId)
            ->select(
                'courses.course_id',
                'courses.title',
                'courses.description',
                'courses.thumbnail',
                'courses.price'
            )
            ->get();

        foreach ($courses as $course) {

            // Total lessons
            $totalLessons = DB::table('lessons')
                ->join(
                    'sections',
                    'lessons.section_id',
                    '=',
                    'sections.section_id'
                )
                ->where('sections.course_id', $course->course_id)
                ->count();

            // Completed lessons
            $completedLessons = DB::table('course_progress')
                ->join(
                    'lessons',
                    'course_progress.lesson_id',
                    '=',
                    'lessons.lesson_id'
                )
                ->join(
                    'sections',
                    'lessons.section_id',
                    '=',
                    'sections.section_id'
                )
                ->where('sections.course_id', $course->course_id)
                ->where(
                    'course_progress.student_id',
                    $studentId
                )
                ->where(
                    'course_progress.completed',
                    1
                )
                ->count();

            $course->totalLessons = $totalLessons;
            $course->completedLessons = $completedLessons;

            // Progress
            if ($totalLessons > 0) {
                $course->progress = round(
                    ($completedLessons / $totalLessons) * 100
                );
            } else {
                $course->progress = 0;
            }

            // Status
            if (
                $totalLessons > 0 &&
                $completedLessons == $totalLessons
            ) {
                $course->status = 'completed';
            } else {
                $course->status = 'in_progress';
            }
        }

        return view(
            'student.courses',
            compact('courses')
        );
    }


    // =========================
    // Course Player
    // =========================
    public function coursePlayer($course_id)
    {
        $studentId = Auth::id();

        // Check if student is enrolled
        $enrolled = DB::table('enrollments')
            ->where('student_id', $studentId)
            ->where('course_id', $course_id)
            ->exists();

        if (!$enrolled) {
            abort(403, 'You are not enrolled in this course.');
        }

        // Get course
        $course = DB::table('courses')
            ->where('course_id', $course_id)
            ->first();

        if (!$course) {
            abort(404);
        }

        // Get sections
        $sections = DB::table('sections')
            ->where('course_id', $course_id)
            ->orderBy('section_id')
            ->get();

        // Get lessons inside every section
        foreach ($sections as $section) {

            $section->lessons = DB::table('lessons')
                ->where(
                    'section_id',
                    $section->section_id
                )
                ->orderBy('lesson_order')
                ->get();

            // Add progress to each lesson
            foreach ($section->lessons as $lesson) {

                $progress = DB::table('course_progress')
                    ->where(
                        'student_id',
                        $studentId
                    )
                    ->where(
                        'lesson_id',
                        $lesson->lesson_id
                    )
                    ->first();

                $lesson->completed = $progress
                    ? $progress->completed
                    : 0;
            }
        }

        return view(
            'student.courseplayer',
            compact('course', 'sections')
        );
    }


    // =========================
    // Quizzes List
    // =========================
    public function quizzes()
    {
        $quizzes = DB::table('quizzes')
            ->orderBy('quiz_id')
            ->get();

        return view(
            'student.quizzes',
            compact('quizzes')
        );
    }


    // =========================
    // Single Quiz
    // =========================
    public function quiz($quiz_id)
    {
        $quiz = DB::table('quizzes')
            ->where('quiz_id', $quiz_id)
            ->first();

        if (!$quiz) {
            abort(404);
        }

        $questions = DB::table('questions')
            ->where('quiz_id', $quiz_id)
            ->get();

        foreach ($questions as $question) {

            $question->options = DB::table('options')
                ->where(
                    'question_id',
                    $question->question_id
                )
                ->get();
        }

        return view(
            'student.quiz',
            compact('quiz', 'questions')
        );
    }


    // =========================
    // Submit Quiz
    // =========================
    public function submitQuiz(
        Request $request,
        $quiz_id
    ) {
        $studentId = Auth::id();

        $answers = $request->input(
            'answers',
            []
        );

        $questions = DB::table('questions')
            ->where('quiz_id', $quiz_id)
            ->get();

        $score = 0;

        foreach ($questions as $question) {

            if (
                isset(
                    $answers[$question->question_id]
                )
            ) {

                $correctOption = DB::table('options')
                    ->where(
                        'question_id',
                        $question->question_id
                    )
                    ->where(
                        'is_correct',
                        1
                    )
                    ->first();

                if (
                    $correctOption &&
                    $answers[$question->question_id]
                    == $correctOption->option_id
                ) {
                    $score++;
                }
            }
        }

        $totalQuestions = $questions->count();

        $percentage = $totalQuestions > 0
            ? round(
                ($score / $totalQuestions) * 100,
                2
            )
            : 0;

        // Save result
        DB::table('quiz_results')->insert([
            'student_id' => $studentId,
            'quiz_id' => $quiz_id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'percentage' => $percentage,
            'created_at' => now(),
        ]);

        return redirect()
            ->route('student.grades')
            ->with(
                'success',
                'Quiz submitted successfully!'
            );
    }


    // =========================
    // Grades
    // =========================
    public function grades()
    {
        $studentId = Auth::id();

        return view(
            'student.grades',
            compact('grades')
        );
    }
    // =========================
    // update profile
    // =========================
public function updateProfile(Request $request)
{
    $studentId = Auth::id();

    $request->validate([
        'phone' => 'nullable|string|max:20',
    ]);

    DB::table('users')
        ->where('user_id', $studentId)
        ->update([
            'phone' => $request->phone,
        ]);

    return redirect()
        ->route('student.profile')
        ->with('success', 'Phone number updated successfully!');
}



}