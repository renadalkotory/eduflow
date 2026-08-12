<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = DB::table('lessons')
            ->join(
                'sections',
                'lessons.section_id',
                '=',
                'sections.section_id'
            )
            ->join(
                'courses',
                'sections.course_id',
                '=',
                'courses.course_id'
            )
            ->select(
                'lessons.lesson_id',
                'lessons.title as lesson_title',
                'lessons.duration',
                'lessons.lesson_order',
                'sections.title as section_title',
                'courses.title as course_title'
            )
            ->orderBy('lessons.lesson_id', 'desc')
            ->get();

        return view('admin.lessons.index', compact('lessons'));
    }
}