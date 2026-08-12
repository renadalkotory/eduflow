<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = DB::table('quizzes')
            ->join('sections', 'quizzes.section_id', '=', 'sections.section_id')
            ->join('courses', 'sections.course_id', '=', 'courses.course_id')
            ->select(
                'quizzes.quiz_id',
                'quizzes.title as quiz_title',
                'quizzes.total_marks',
                'sections.title as section_title',
                'courses.title as course_title'
            )
            ->orderBy('quizzes.quiz_id', 'desc')
            ->get();

        return view('admin.quizzes.index', compact('quizzes'));
    }
}