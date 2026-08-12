<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total users
        $totalUsers = User::count();

        // Total students
        $totalStudents = User::where('role', 'student')->count();

        // Total instructors
        $totalInstructors = User::where('role', 'instructor')->count();

        // Total admins
        $totalAdmins = User::where('role', 'admin')->count();

        // Total courses
        $totalCourses = DB::table('courses')->count();

        // Total revenue from paid enrollments
        $totalRevenue = DB::table('enrollments')
            ->join(
                'courses',
                'enrollments.course_id',
                '=',
                'courses.course_id'
            )
            ->where('enrollments.payment_status', 'Paid')
            ->sum('courses.price');

        // Popular courses
        $popularCourses = DB::table('courses')
            ->leftJoin(
                'enrollments',
                'courses.course_id',
                '=',
                'enrollments.course_id'
            )
            ->select(
                'courses.course_id',
                'courses.title',
                'courses.price',
                'courses.views',
                DB::raw('COUNT(enrollments.enrollment_id) as enrollment_count')
            )
            ->groupBy(
                'courses.course_id',
                'courses.title',
                'courses.price',
                'courses.views'
            )
            ->orderByDesc('enrollment_count')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStudents',
            'totalInstructors',
            'totalAdmins',
            'totalCourses',
            'totalRevenue',
            'popularCourses'
        ));
    }
}