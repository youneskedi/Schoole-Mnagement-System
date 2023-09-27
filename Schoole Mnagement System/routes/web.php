<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    Auth::logout();
    return view('login');
});

Auth::routes();

Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class , 'index'])->name('admin.dashboard')->middleware('role:admin');
Route::get('/student/dashboard', [\App\Http\Controllers\Student\DashboardController::class , 'index'])->name('student.dashboard')->middleware('role:student');
Route::get('/teacher/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class , 'index'])->name('teacher.dashboard')->middleware('role:teacher');

//Admin Route...
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::resource('teacher' , TeacherController::class);
    Route::resource('student' , StudentController::class);

    Route::resource('course' , \App\Http\Controllers\CourseController::class);
    Route::post('/addToCourse/{course}', [CourseController::class, 'store'])->name('add_to_course');
    Route::post('/course/store2', [CourseController::class, 'store2'])->name('course.store2');

    Route::get('/certif' , [\App\Http\Controllers\Admin\CertifController::class , 'index'])->name('certif.index');
    Route::get('/certif/show/{course}' , [\App\Http\Controllers\Admin\CertifController::class , 'show'])->name('certif.show');
    Route::get('/certif/store/{course}' , [\App\Http\Controllers\Admin\CertifController::class , 'store'])->name('certif.store');
    Route::post('/certif/update/{certif}' , [\App\Http\Controllers\Admin\CertifController::class , 'update'])->name('certif.update');
    Route::get('/certif/store2/{course}' , [\App\Http\Controllers\Admin\CertifController::class , 'store2'])->name('certif.store2');

    Route::resource('admin' , App\Http\Controllers\Admin\AdminContrller::class)->middleware('role:admin');
});

//common admin and teacher
Route::group(['middleware' => 'admin_teacher'], function () {
    Route::resource('asignment', \App\Http\Controllers\AsignmentController::class);
    Route::get('/asignment/create/{id}', [\App\Http\Controllers\AsignmentController::class, 'create'])->name('asignment.create');
    Route::post('/asignment/{id}/store', [\App\Http\Controllers\AsignmentController::class, 'store'])->name('asignment.store');
    Route::post('/asignment/{asignment}/destroy', [\App\Http\Controllers\AsignmentController::class, 'destroy2'])->name('asignment.destroy');

    Route::resource('lecture', \App\Http\Controllers\LectureController::class);
    Route::get('/lecture/index/{session}', [\App\Http\Controllers\LectureController::class, 'index'])->name('lecture.index');
    Route::get('/lecture/create/{id}', [\App\Http\Controllers\LectureController::class, 'create'])->name('lecture.create');
    Route::post('/lecture/{id}/store', [\App\Http\Controllers\LectureController::class, 'store'])->name('lecture.store');

    Route::resource('session', \App\Http\Controllers\SessionController::class);
    Route::get('/session/index/{course}', [\App\Http\Controllers\SessionController::class, 'index'])->name('session.index');
    Route::get('/session/create/{course}', [\App\Http\Controllers\SessionController::class, 'create'])->name('session.create');
    Route::put('/session/{course}/store', [\App\Http\Controllers\SessionController::class, 'store'])->name('session.store');

});

//Teacher Role
Route::get('/attendance' , [\App\Http\Controllers\Teacher\Attendance::class , 'index'])->name('attendance.index')->middleware('role:teacher');
Route::prefix('teacher')->name('teacher.')->middleware('role:teacher')->group(function () {
    Route::get('course/index' , [\App\Http\Controllers\Teacher\CourseController::class , 'index'])->name('course.index');
    Route::get('course/addSTC/{course}' , [\App\Http\Controllers\Teacher\CourseController::class , 'addStudentToCourse'])->name('course.addStu');
    Route::post('/addToCourse/{course}', [\App\Http\Controllers\Teacher\CourseController::class, 'store'])->name('add_to_course');
    Route::get('/course/edit/{course}', [\App\Http\Controllers\Teacher\CourseController::class, 'edit'])->name('course.edit');
    Route::get('/course/update/{course}', [\App\Http\Controllers\Teacher\CourseController::class, 'update'])->name('course.update');

    Route::get('/session/show/{course}', [\App\Http\Controllers\Teacher\SessionController::class , 'show'])->name('session.show');

    Route::post('/asignment/{asignment}/destroy', [\App\Http\Controllers\Teacher\SessionController::class, 'destroy'])->name('asignment.destroy');
    Route::post('/asignment/{asignment}/store', [\App\Http\Controllers\Teacher\SessionController::class, 'update'])->name('asignment.update');

    Route::get('/attendance/show/{course}' , [\App\Http\Controllers\Teacher\Attendance::class , 'show'])->name('attendance.show');
    Route::get('/attendance/store/{course}' , [\App\Http\Controllers\Teacher\Attendance::class , 'store'])->name('attendance.store');

    Route::post('/certif/update/{certif}' , [\App\Http\Controllers\Admin\CertifController::class , 'update'])->name('certif.update');
    Route::get('/certif/store2/{course}' , [\App\Http\Controllers\Admin\CertifController::class , 'store2'])->name('certif.store2');
});

//Student Routes
Route::prefix('student')->name('student.')->middleware('role:student')->group(function () {
    Route::get('course/show' , [\App\Http\Controllers\Student\CourseController::class , 'show'])->name('course.show');

    Route::get('/session/show/{course}', [\App\Http\Controllers\Student\SessionController::class , 'show'])->name('session.show');
    Route::post('/asignment/{asignment}/store', [\App\Http\Controllers\Student\AsignmentController::class, 'update'])->name('asignment.update');
    Route::post('/asignment/{asignment}/destroy', [\App\Http\Controllers\Student\AsignmentController::class, 'destroy'])->name('asignment.destroy');
    Route::post('/asignment/{asignment}/update', [\App\Http\Controllers\Student\AsignmentController::class, 'update2'])->name('asignment.update2');
    Route::post('/asignment/{asignment}/destroy', [\App\Http\Controllers\Student\AsignmentController::class, 'destroy2'])->name('asignment.destroy');


    Route::get('/lecture/index/{session}', [\App\Http\Controllers\Student\LectureController::class , 'index'])->name('lecture.index');

    Route::get('profile/index' , [\App\Http\Controllers\Student\ProfileController::class , 'index'])->name('profile.index');
    Route::post('/profile/{user}/update' , [\App\Http\Controllers\Student\ProfileController::class , 'update'])->name('profile.update');
    Route::get('/certif/index' , [\App\Http\Controllers\Student\CertifController::class , 'index'])->name('certif.index');
});

Route::get('/test' , function() {
    return view('test') ;
});



