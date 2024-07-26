<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\ClassroomSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ClassroomController;

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

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Route::middleware(['role:admin'])->group(function () {//});
    // Routes accessible only by admins
Route::get('/admin/schools', [AdminController::class, 'schools'])->name('admin.schools');

    Route::post('/hire-teacher', [AdminController::class, 'hireTeacher'])->name('admin.hire_teacher');
    
Route::get('/admin/teachers/{teacher}/edit', [AdminController::class, 'editteacher'])->name('admin.teachers.edit');
Route::put('admin/teachers/{teacher}', [AdminController::class, 'updateteacher'])->name('admin.teachers.update');


    Route::post('/assign-teacher-to-classroom/{teacher}/{classroom}', [AdminController::class, 'assignTeacherToClassroom'])->name('admin.assign_teacher_to_classroom');
 
 Route::post('/assign-student-to-classroom/{student}/{classroom}', [AdminController::class, 'testassing'])->name('admin.assign_student_to_classroom');


Route::get('/admin/schools/bystate/{stateabv}', [AdminController::class, 'findschool'])->name('admin.schoolsbystate');
Route::get('/admin/schools/getschool/{id}', [AdminController::class, 'getschool'])->name('admin.getschool');

Route::get('/admin/schools/getclassroom/{id}', [AdminController::class, 'getclassroom'])->name('admin.getclassroom');

Route::get('/classroom', [TeacherController::class, 'classroom'])->name('teacher.classroom');

Route::resource('student-info', StudentInfoController::class);

// Define routes for Classroom Sessions
Route::prefix('classroom-sessions')->group(function () {
    Route::get('/', [ClassroomSessionController::class, 'index'])->name('classroom-sessions.index');
    // Add other routes for creating, updating, deleting, etc.
});


Route::get('parent/family', [ParentController::class, 'showFamily'])->name('parent.family');
Route::get('/schools', [SchoolController::class, 'index'])->name('school');
Route::get('/schools/homeroom', [SchoolController::class, 'homeroom'])->name('homeroom');

Route::get('/class/{id}', [ClassroomController::class, 'show'])->name('classroom.show');

require __DIR__.'/auth.php';
