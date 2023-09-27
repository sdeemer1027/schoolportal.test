<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Apply 'auth' middleware to all methods in this controller
    }



    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
        $teachers = [];
        $students = [];
        if ($user->hasRole('admin')) {
            // User is an admin, retrieve all teachers and students
            $teachers = User::whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            })->get();
            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->get();
        }

        if ($user->hasRole('teacher')) {
           $schoolid= $user->school_id;
            $teachers = User::whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            })
                ->where('school_id', $schoolid)
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join the schools table
                ->select('users.*', 'schools.name as school_name') // Select the school name as 'school_name'
                ->get();
            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })
                ->where('school_id', $schoolid)
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join the schools table
                ->select('users.*', 'schools.name as school_name') // Select the school name as 'school_name'
            ->get();


        }

        if ($user->hasRole('parent')) {
            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->get();
        }


        return view('dashboard', compact('teachers', 'students','user'));
    }
}
