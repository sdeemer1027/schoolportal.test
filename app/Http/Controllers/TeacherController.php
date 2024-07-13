<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;

class TeacherController extends Controller
{
    //



    


     public function classrom()
    {
       $user = Auth::user(); // Get the currently logged-in user

     // Filter classrooms by the current user's ID
        $classrooms = Classroom::whereHas('teachers', function ($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })->with('teachers')->get();


        return view('teacher.classroom', compact('user','classrooms'));

   }
}
