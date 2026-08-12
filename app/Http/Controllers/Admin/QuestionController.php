<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = DB::table('questions')
            ->join('quizzes', 'questions.quiz_id', '=', 'quizzes.quiz_id')
            ->select(
                'questions.question_id',
                'questions.question',
                'quizzes.title as quiz_title',
                'quizzes.quiz_id'
            )
            ->orderBy('questions.question_id', 'desc')
            ->get();

        return view('admin.questions.index', compact('questions'));
    }
}