<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

//browse courses
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories');

    Route::get('/browse-courses', function () {

    $query = \App\Models\Course::where('status', 'Published');



    if (request('category_id')) {

        $query->where('category_id', request('category_id'));

    }



    $courses = $query->get();

    return view('Elearning.browsecourses', compact('courses'));

})->name('browse.courses');
//////////////////////////////////

Route::get('/courses/{course}', [CourseController::class, 'show'])
    ->name('courses.show');

Route::get('/', function () {
    return view('Elearning.Landingpage');
})->name('home');

Route::get('/login', function () {
    return view('Elearning.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/signup', [AuthController::class, 'showSignup'])
    ->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/browse-courses', function () {
    $courses = \App\Models\Course::where('status', 'Published')->get();
    return view('Elearning.browsecourses', compact('courses'));
})->name('browse.courses');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/checkout', [CartController::class, 'checkout'])
    ->name('cart.checkout');

Route::post('/cart/add', [CartController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

Route::get('/instructor/profile', [InstructorController::class, 'profile'])->name('instructor.profile');
Route::get('/instructor/courses/create', [InstructorController::class, 'createCourse'])->name('instructor.createCourse');
Route::get('/instructor/courses/manage', [InstructorController::class, 'manageCourse'])->name('instructor.manageCourse');
Route::get('/instructor/quiz/create', [InstructorController::class, 'createQuiz'])->name('instructor.createQuiz');
Route::get('/instructor/grade-tests', [InstructorController::class, 'gradeTests'])->name('instructor.gradeTests');
Route::get('/instructor/students', [InstructorController::class, 'students'])->name('instructor.students');

Route::delete('/cart/remove/{course_id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::patch('/cart/update/{course_id}', [CartController::class, 'updateQty'])
    ->name('cart.update');

Route::get('/instructor/dashboard', [InstructorController::class, 'dashboard'])
    ->name('instructor.dashboard');

//
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'instructor' => redirect()->route('instructor.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => redirect('/'),
    };
})->name('dashboard');

//
// =========================
// Student Routes
// =========================

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
    ->name('student.dashboard');

Route::get('/student/profile', [StudentController::class, 'profile'])
    ->name('student.profile');

Route::put('/student/profile', [StudentController::class, 'updateProfile'])
    ->name('student.profile.update');

Route::get('/student/courses', [StudentController::class, 'courses'])
    ->name('student.courses');

Route::get('/student/courseplayer/{course_id}', [StudentController::class, 'coursePlayer'])
    ->name('student.courseplayer');

Route::get('/student/quizzes', [StudentController::class, 'quizzes'])
    ->name('student.quizzes');

Route::get('/student/quiz/{quiz_id}', [StudentController::class, 'quiz'])
    ->name('student.quiz');

Route::post('/student/quiz/{quiz_id}/submit', [StudentController::class, 'submitQuiz'])
    ->name('student.quiz.submit');

Route::get('/student/grades', [StudentController::class, 'grades'])
    ->name('student.grades');


// =========================
// Admin Routes
// =========================

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Users
    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');

    // Categories
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])
        ->name('admin.categories.edit');

    Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');

    // Courses (Admin)
    Route::get('/admin/courses', [AdminCourseController::class, 'index'])
        ->name('admin.courses.index');

    Route::get('/admin/courses/create', [AdminCourseController::class, 'create'])
        ->name('admin.courses.create');

    Route::post('/admin/courses', [AdminCourseController::class, 'store'])
        ->name('admin.courses.store');

    Route::get('/admin/courses/{course}/edit', [AdminCourseController::class, 'edit'])
        ->name('admin.courses.edit');

    Route::put('/admin/courses/{course}', [AdminCourseController::class, 'update'])
        ->name('admin.courses.update');

    Route::delete('/admin/courses/{course}', [AdminCourseController::class, 'destroy'])
        ->name('admin.courses.destroy');

    // Enrollments
    Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])
        ->name('admin.enrollments.index');

    // Quizzes
    Route::get('/admin/quizzes', [QuizController::class, 'index'])
        ->name('admin.quizzes.index');

    // Questions
    Route::get('/admin/questions', [QuestionController::class, 'index'])
        ->name('admin.questions.index');

    // Options
    Route::get('/admin/options', [OptionController::class, 'index'])
        ->name('admin.options.index');

    // Sections
    Route::get('/admin/sections', [SectionController::class, 'index'])
        ->name('admin.sections.index');

    // Lessons
    Route::get('/admin/lessons', [LessonController::class, 'index'])
        ->name('admin.lessons.index');
        
        Route::post('/instructor/courses', [InstructorController::class, 'storeCourse'])
    ->name('instructor.courses.store');
});
