<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'getCourses'])->name('front');
Auth::routes();

Route::prefix('admin')->name('admin.')->middleware('can:admin-routes')->group(function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'indexAdmin'])->name('index');
    Route::resource('/users',     App\Http\Controllers\Admin\UsersController::class);
    Route::get('/users/{id}/update-status', [App\Http\Controllers\Admin\UsersController::class, 'updateStatus'])->name('users.update.status');
    Route::resource('/languages', App\Http\Controllers\Admin\LanguagesController::class);
    Route::resource('/courses',   App\Http\Controllers\Admin\CoursesController::class);
});

Route::prefix('teacher')->name('teacher.')->middleware('can:teacher-routes')->group(function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'indexTeacher'])->name('index');
    Route::resource('/lessons', App\Http\Controllers\Teacher\LessonsController::class);

    Route::get('/quiz/index',  [App\Http\Controllers\Teacher\QuizController::class, 'index'])->name('quiz.index');
    
    Route::get('/quiz/create',  [App\Http\Controllers\Teacher\QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store',  [App\Http\Controllers\Teacher\QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/{id}/edit', [App\Http\Controllers\Teacher\QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{id}/update', [App\Http\Controllers\Teacher\QuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quiz/{id}/destory', [App\Http\Controllers\Teacher\QuizController::class, 'destory'])->name('quiz.destroy');
    
    // Questions and Answers
    Route::get('/quiz/qa-create',  [App\Http\Controllers\Teacher\QuizController::class, 'createQuestionAndAnswers'])->name('quiz.qa-create');
    Route::post('/quiz/qa-store',  [App\Http\Controllers\Teacher\QuizController::class, 'storeQuestionAndAnswers'])->name('quiz.qa-store');    
});

Route::prefix('user')->name('user.')->middleware('can:user-routes')->group(function () {
    Route::get('/quiz', [App\Http\Controllers\User\QuizController::class, 'index'])->name('quiz.index');
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');

    Route::get('/course/{id}/lessons', [App\Http\Controllers\Admin\CoursesController::class, 'getLessonsByCourseId'])->name('course.lessons');
    Route::get('/course/{id}/lessons/{lesson_id}', [App\Http\Controllers\Admin\CoursesController::class, 'getLessonById'])->name('course.lesson.show');
    Route::post('/quiz/store-result', [App\Http\Controllers\User\QuizController::class, 'storeResult'])->name('quiz.store.result');
    
    Route::delete('/rating/destroy/{id}', [App\Http\Controllers\User\CourseController::class, 'destroyRating'])->name('rating.destroy');
});

Route::get('/quiz/{id}', [App\Http\Controllers\User\QuizController::class, 'getQuizByLanguageId'])->name('user.quiz.language.id');
Route::post('/quiz/store', [App\Http\Controllers\User\QuizController::class, 'store'])->name('user.quiz.store');
