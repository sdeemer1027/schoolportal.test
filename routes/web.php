<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentController;


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









require __DIR__.'/auth.php';
