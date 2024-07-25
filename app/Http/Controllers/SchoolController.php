<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\ClassroomSchedule;


class SchoolController extends Controller
{
    public function index()
    {

   $user = Auth::user(); // Get the currently logged-in user
 //  $school =School::where('id', $user->school_id)->with(['classrooms.schedules'])->first();
 // Fetch the school with its classrooms and schedules
        $school = School::with(['classrooms.schedules'])->findOrFail($user->school_id);


return view('school' ,compact('user','school'));

    }

    public function homeroom()
    {



   $user = Auth::user(); // Get the currently logged-in user
   $school =School::where('id', $user->school_id)->first();
   $students='';

return view('homeroom' ,compact('user','school'));

    }
}
