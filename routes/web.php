<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstructorController;
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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/browse-courses', function () {
    return view('Elearning.browsecourses');
})->name('browse.courses');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{course_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{course_id}', [CartController::class, 'updateQty'])->name('cart.update');

Route::get('/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');