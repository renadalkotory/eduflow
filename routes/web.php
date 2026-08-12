<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Elearning.Landingpage');
})->name('home');

Route::get('/login', function () {
    return view('Elearning.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

Route::get('/browse-courses', function () {
    return view('Elearning.browsecourses');
})->name('browse.courses');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{course_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{course_id}', [CartController::class, 'updateQty'])->name('cart.update');
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
    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('admin.categories.edit');

    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');

    // Courses
    Route::get('/admin/courses', [CourseController::class, 'index'])
        ->name('admin.courses.index');

    Route::get('/admin/courses/create', [CourseController::class, 'create'])
        ->name('admin.courses.create');

    Route::post('/admin/courses', [CourseController::class, 'store'])
        ->name('admin.courses.store');

    Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('admin.courses.edit');

    Route::put('/admin/courses/{course}', [CourseController::class, 'update'])
        ->name('admin.courses.update');

    Route::delete('/admin/courses/{course}', [CourseController::class, 'destroy'])
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
});