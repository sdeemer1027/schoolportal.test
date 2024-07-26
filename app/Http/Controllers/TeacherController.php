<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use Carbon\Carbon;
use App\Models\ClassroomSession;
use App\Models\ClassroomSchedule;


class TeacherController extends Controller
{
    //



    


     public function classroom()
    {
       $user = Auth::user(); // Get the currently logged-in user

   

// Filter classrooms by the current user's ID
    $classrooms = Classroom::whereHas('teachers', function ($query) use ($user) {
        $query->where('teacher_id', $user->id);
    })->with('teachers')->get();

$schedule = ClassroomSchedule::where('teacher_id', $user->id)->with('student')->get();

//dd($schedule);













        return view('teacher.homeroom', compact('user','classrooms','schedule'));

   }
}
