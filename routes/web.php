<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\ClassroomSessionController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/dashboard', [DashboardController:class, 'index'])->name('dashboard');


Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['role:admin'])->group(function () {
    // Routes accessible only by admins
Route::get('/admin/schools', [AdminController::class, 'schools'])->name('admin.schools');
    Route::post('/hire-teacher', [AdminController::class, 'hireTeacher'])->name('admin.hire_teacher');
    Route::post('/assign-teacher-to-classroom/{teacher}/{classroom}', [AdminController::class, 'assignTeacherToClassroom'])->name('admin.assign_teacher_to_classroom');
    Route::post('/assign-student-to-classroom/{student}/{classroom}', [AdminController::class, 'assignStudentToClassroom'])->name('admin.assign_student_to_classroom');

});

Route::middleware(['role:employee'])->group(function () {
    // Routes accessible only by admins
});

Route::middleware(['role:teacher'])->group(function () {
    // Routes accessible only by admins
});

Route::middleware(['role:coach'])->group(function () {
    // Routes accessible only by admins
});

Route::middleware(['role:counselor'])->group(function () {
    // Routes accessible only by admins
});

Route::middleware(['role:student'])->group(function () {
    // Routes accessible only by admins
});

Route::middleware(['role:parent'])->group(function () {

    Route::prefix('parents')->group(function () {
        Route::get('{id}', [ParentController::class, 'show'])->name('parents.show');
        Route::get('{id}/students', [ParentController::class, 'manageStudents'])->name('parents.students');
        Route::get('{id}/teachers', [ParentController::class, 'manageTeachers'])->name('parents.teachers');
    });

});

Route::middleware(['permission:create articles'])->group(function () {
    // Routes accessible only by users with the 'create articles' permission
});


Route::resource('student-info', StudentInfoController::class);

// Define routes for Classroom Sessions
Route::prefix('classroom-sessions')->group(function () {
    Route::get('/', [ClassroomSessionController::class, 'index'])->name('classroom-sessions.index');
    // Add other routes for creating, updating, deleting, etc.
});





require __DIR__.'/auth.php';
