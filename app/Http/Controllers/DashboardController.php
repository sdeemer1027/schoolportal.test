<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


//            $user = $request->user();
            $userZip = $user->zip; // Get the user's ZIP code

            // Check if the user's ZIP code is not null
            if (!empty($userZip)) {
                // Query to retrieve schools within 25 miles of the user's ZIP code
// Assuming you have the user's latitude and longitude in $userLatitude and $userLongitude
                $zipinfo= DB::table('zipcodes')->where('zip',$userZip)->first();

                $userLatitude=$zipinfo->lat;
                $userLongitude=$zipinfo->lng;
                //          dd($userZip,$userLatitude,$userLongitude,$zipinfo);


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

// Dump the results to inspect
                //         dd($schoolsWithin25Miles);

                $uniqueStates = School::distinct()->pluck('state');

   //             return view('profile.edit', [
   //                 'user' => $user,
   //                 'uniqueStates' => $uniqueStates,
   //                 'schoolsWithin25Miles' => $schoolsWithin25Miles,
   //             ]);
                return view('dashboard', compact('teachers', 'students','user','uniqueStates','schoolsWithin25Miles'));

            }


            $uniqueStates = School::distinct()->pluck('state');

//dd($uniqueStates);
//            return view('profile.edit', [
//                'user' => $request->user(),
//                'uniqueStates' => $uniqueStates, // Pass the unique states as a parameter

//            ]);
            return view('dashboard', compact('teachers', 'students','user','uniqueStates'));



        }


        return view('dashboard', compact('teachers', 'students','user'));
    }
}
