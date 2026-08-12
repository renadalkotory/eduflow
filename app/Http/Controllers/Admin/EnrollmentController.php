<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = DB::table('enrollments')
            ->join('users', 'enrollments.student_id', '=', 'users.user_id')
            ->join('courses', 'enrollments.course_id', '=', 'courses.course_id')
            ->select(
                'enrollments.enrollment_id',
                'users.full_name as student_name',
                'courses.title as course_title',
                'enrollments.enrolled_at',
                'enrollments.payment_status'
            )
            ->orderBy('enrollments.enrollment_id', 'desc')
            ->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }
}