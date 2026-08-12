<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function index()
    {
        $sections = DB::table('sections')
            ->join(
                'courses',
                'sections.course_id',
                '=',
                'courses.course_id'
            )
            ->select(
                'sections.section_id',
                'sections.title as section_title',
                'sections.section_order',
                'courses.title as course_title'
            )
            ->orderBy('sections.section_id', 'desc')
            ->get();

        return view('admin.sections.index', compact('sections'));
    }
}