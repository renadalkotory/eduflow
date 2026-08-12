<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructorController;
Route::prefix('instructor')->group(function () {
    /*PROFILE*/
    Route::get('/profile', [InstructorController::class, 'profile'])
        ->name('instructor.profile');

    Route::post('/profile', [InstructorController::class, 'updateProfile'])
        ->name('instructor.profile.update');

    Route::post('/credentials', [InstructorController::class, 'storeCredential'])
        ->name('instructor.credentials.store');
    /*CREATE COURSE*/
    Route::get('/create-course', [InstructorController::class, 'createCourse'])
        ->name('instructor.createCourse');

    Route::post('/create-course', [InstructorController::class, 'storeCourse'])
        ->name('instructor.storeCourse');

    Route::post('/create-course/draft', [InstructorController::class, 'saveDraft'])
        ->name('instructor.saveDraft');
    /* MANAGE COURSE*/
    Route::get('/manage-course/{course?}', [InstructorController::class, 'manageCourse'])
        ->name('instructor.manageCourse');

    Route::post('/courses/{course}/sections', [InstructorController::class, 'storeSection'])
        ->name('instructor.sections.store');

    Route::post('/sections/{section}/lessons', [InstructorController::class, 'storeLesson'])
        ->name('instructor.lessons.store');

    Route::delete('/sections/{section}', [InstructorController::class, 'deleteSection'])
        ->name('instructor.sections.destroy');

    Route::delete('/lessons/{lesson}', [InstructorController::class, 'deleteLesson'])
        ->name('instructor.lessons.destroy');



    /* CREATE QUIz*/


    Route::get('/create-quiz/{quiz?}', [InstructorController::class, 'createQuiz'])
        ->name('instructor.createQuiz');

    Route::post('/create-quiz', [InstructorController::class, 'storeQuiz'])
        ->name('instructor.storeQuiz');



/* GRADE TESTS*/


    Route::get('/grade-tests', [InstructorController::class, 'gradeTests'])
        ->name('instructor.gradeTests');

    Route::patch('/submissions/{submission}', [InstructorController::class, 'updateSubmission'])
        ->name('instructor.submissions.update');

});
