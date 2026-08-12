<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function index()
    {
        $options = DB::table('options')
            ->join(
                'questions',
                'options.question_id',
                '=',
                'questions.question_id'
            )
            ->join(
                'quizzes',
                'questions.quiz_id',
                '=',
                'quizzes.quiz_id'
            )
            ->select(
                'options.option_id',
                'options.option_text',
                'options.is_correct',
                'questions.question',
                'quizzes.title as quiz_title'
            )
            ->orderBy('options.option_id', 'desc')
            ->get();

        return view('admin.options.index', compact('options'));
    }
}