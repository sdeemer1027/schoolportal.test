<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use Carbon\Carbon;
use App\Models\ClassroomSession;
use App\Models\ClassroomSchedule;
use App\Models\Student;


class ClassroomController extends Controller
{
     public function index()
    {

    }

     public function show222($id)
    {

      // dd($id);
 $user = Auth::user(); // Get the currently logged-in user

    // Retrieve the classroom by ID
    $classroom = Classroom::with('students', 'teachers')->findOrFail($id);

    // Get the current date and time
    $currentDateTime = now();

    // Get the current day of the week and time
    $currentDay = $currentDateTime->format('l'); // Full textual representation of the day (e.g., Monday)
    $currentTime = $currentDateTime->format('H:i'); // Current time in 24-hour format (e.g., 15:00)

    // Retrieve the classroom schedule for the current day and time
    $schedule = ClassroomSchedule::where('classroom_id', $id)
        ->where('schedule_time', '<=', $currentTime)
        ->whereDate('created_at', $currentDateTime->toDateString()) // Make sure the date matches if needed
        ->orderBy('schedule_time', 'desc')
        ->first(); // Get the most recent schedule time that is less than or equal to the current time

    // Get the teacher assigned to the classroom (assuming one teacher per classroom)
    $teacher = $classroom->teachers->first(); // Or modify based on your relationships

    // Pass the classroom, students, teacher, and schedule to the view
    return view('class', compact('user', 'classroom', 'schedule', 'teacher'));

    }



public function show($id)
{
    // Get the currently logged-in user
    $user = Auth::user();

    // Retrieve the classroom by ID with relationships
    $classroom = Classroom::with('students', 'teachers')->findOrFail($id);

    // Get the current date and time
    $currentDateTime = now();
    $currentTime = $currentDateTime->format('H:i'); // Current time in 24-hour format

    // Retrieve the schedule for the classroom at the current time
    $schedule = ClassroomSchedule::where('classroom_id', $id)
        ->where('schedule_time', '<=', $currentTime)
        ->orderBy('schedule_time', 'desc')
        ->get(); // Get the most relevant schedule

//dd($schedule);


    // Check if there is a schedule for the current time
    if ($schedule) {
        // Retrieve students assigned to this schedule
        $studentsInClass = $schedule->students()->whereHas('classrooms', function ($query) use ($id) {
            $query->where('classroom_id', $id);
        })->get();
    } else {
        $studentsInClass = collect(); // No schedule found, no students to show
    }

    // Get the teacher assigned to the classroom (assuming one teacher per classroom)
    $teacher = $classroom->teachers->first(); // Or modify based on your relationships

    // Pass the classroom, students, teacher, and schedule to the view
    return view('class', compact('user', 'classroom', 'schedule', 'teacher', 'studentsInClass'));
}

















}
