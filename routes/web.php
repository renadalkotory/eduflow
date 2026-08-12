<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


// =========================
// Home
// =========================

Route::get('/', function () {
    return view('Elearning.Landingpage');
})->name('home');


// =========================
// Authentication
// =========================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/signup', [AuthController::class, 'showSignup'])
    ->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =========================
// Browse Courses
// =========================

Route::get('/browse-courses', function () {
    return view('Elearning.browsecourses');
})->name('browse.courses');


// =========================
// Student Pages
// =========================

Route::middleware('auth')->prefix('student')->group(function () {

    // Dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    // Profile
    Route::get('/profile', [StudentController::class, 'profile'])
        ->name('student.profile');

    Route::post('/profile/update', [StudentController::class, 'updateProfile'])
        ->name('student.profile.update');

    // My Courses
    Route::get('/courses', [StudentController::class, 'courses'])
        ->name('student.courses');

    // Course Player
    Route::get('/courseplayer/{course_id}', [StudentController::class, 'coursePlayer'])
        ->name('student.courseplayer');

    // Quizzes List
    Route::get('/quizzes', [StudentController::class, 'quizzes'])
        ->name('student.quizzes');

    // Single Quiz
    Route::get('/quiz/{quiz_id}', [StudentController::class, 'quiz'])
        ->name('student.quiz');

    // Submit Quiz
    Route::post('/quiz/{quiz_id}/submit', [StudentController::class, 'submitQuiz'])
        ->name('student.quiz.submit');

    // Grades
    Route::get('/grades', [StudentController::class, 'grades'])
        ->name('student.grades');
});


// =========================
// Cart
// =========================

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::delete('/cart/remove/{course_id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::patch('/cart/update/{course_id}', [CartController::class, 'updateQty'])
    ->name('cart.update');

Route::delete('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');