<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;
use App\Models\ClassroomSchedule;
use App\Models\Classroom;
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
$schoolName =[];
$parents =[];

if ($user->hasRole('admin')) {
    // User is an admin, retrieve all teachers and students
    $teachersQuery = User::whereHas('roles', function ($query) {
        $query->where('name', 'teacher');
    });

    $studentsQuery = User::whereHas('roles', function ($query) {
        $query->where('name', 'student');
    });
    $parentsQuery = User::whereHas('roles', function ($query) {
        $query->where('name', 'parent');
    });

    $teachers = $teachersQuery->paginate(10); //->get();
    $students = $studentsQuery->paginate(10); //->get();
    $parents = $parentsQuery->paginate(10); //->get();
    $schoolName =[];






return view('dashboardadmin', compact('teachers', 'students','user','schoolName'));


          }

// teacher role
if ($user->hasRole('teacher')) {
     $schoolid = $user->school_id;
     $schoolName =School::find($user->school_id);
    
//$schoolName = School::where('id',$user->school_id)



    // Common base query for both teachers and students
    $baseQuery = User::where('school_id', $schoolid)
        ->leftJoin('schools', 'users.school_id', '=', 'schools.id')
        ->leftJoin('classroom_teacher', 'users.id', '=', 'classroom_teacher.teacher_id')
        ->select('users.*', 'schools.name as school_name', 'schools.address as school_address', 'schools.city as school_city','classroom_teacher.*');

    // Teachers specific conditions
    $teachers = $baseQuery
        ->whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })
        ->get();
//    dd($teachers);
    $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })
                ->where('school_id', $schoolid)
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join the schools table
                ->select('users.*', 'schools.name as school_name') // Select the school name as 'school_name'
            ->get();

         }
//end teacher role

// parent role
        if ($user->hasRole('parent')) {
             $students = '';
             $userZip = $user->zip; // Get the user's ZIP code

            // Check if the user's ZIP code is not null
            if (!empty($userZip)) {
                // Query to retrieve schools within 25 miles of the user's ZIP code
                // Assuming you have the user's latitude and longitude in $userLatitude and $userLongitude
                $zipinfo= DB::table('zipcodes')->where('zip',$userZip)->first();

                $userLatitude=$zipinfo->lat;
                $userLongitude=$zipinfo->lng;
               
                // Query to retrieve schools within 25 miles of the user's location
                $schoolsWithin25Miles = DB::table('schools')
                    ->select('schools.id', 'schools.name', 'schools.address', 'schools.city', 'schools.state', 'schools.zip')
                    ->join('zipcodes', 'schools.zip', '=', 'zipcodes.zip')
                    ->whereRaw("
        3959 * ACOS(
            SIN(RADIANS(zipcodes.lat)) * SIN(RADIANS(?))
            + COS(RADIANS(zipcodes.lat)) * COS(RADIANS(?))
            * COS(RADIANS(zipcodes.lng - ?))
        ) <= 25", [$userLatitude, $userLatitude, $userLongitude])
                    ->get();

                $uniqueStates = School::distinct()->pluck('state');

            return view('dashboard', compact('teachers', 'students','user','uniqueStates','schoolsWithin25Miles' ,'schoolName'));

            }


            $uniqueStates = School::distinct()->pluck('state');
           return view('dashboard', compact('teachers', 'students','user','uniqueStates','schoolName'));
        }
//end parent role

//Start Student Role
        $user = Auth::user();
         if ($user->hasRole('student')) {
            $student= Student::where('user_id', $user->id)
            ->with('classrooms')
            ->first();
               
          $schoolName = $student->classrooms->first()->school->name ?? '';

        // Get the current time and date of the user's computer
        $now = now();

        // Get classroom schedules for the student
        $classschedule = ClassroomSchedule::whereHas('student', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
        ->orderBy('schedule_time', 'asc')
        ->get();
  // Fetch the classroom details for each schedule
        $classrooms = Classroom::whereIn('id', $classschedule->pluck('classroom_id'))->get()->keyBy('id');

//dd($classrooms);
               


           // $currentTime = now()->toDateTimeString(); // Get the current time

             return view('dashboardstudent', compact('teachers', 'user','schoolName','student','classschedule','now','classrooms'));
            }
//End Student Role



$studentinnfo= '';



        return view('dashboard', compact('teachers', 'user','schoolName','students'));
    
    }

}
