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

    $teachers = $teachersQuery->get();
    $students = $studentsQuery->get();
    $parents = $parentsQuery->get();
    $schoolName =[];

//dd($students);

foreach($students as $student){

$data = [
    'user_id' => $student->id,
    'school_id' => $student->school_id,
    // Add other fields as needed
];

$them = Student::firstOrNew(['user_id' => $data['user_id'],'school_id'=>$data['school_id']], $data);

if (!$them->exists) {
    $them->save();
}

//if (!$parents->exists) {
//    dd($student);
//}
if($them->parent_id == null){
// Check if a parent role exists
$parentRole = Role::where('name', 'parent')->first();
$parentUser = User::role('parent')->first();
$faker = Faker::create();
//if (!$parentUser) {
    // Create new parent user
    $parentUser = User::create([
        'name' => $faker->firstName . ' ' . $student->lname, // Provide appropriate name
        'email' =>'parent'.$them->id.'@gmail.com', // Provide appropriate email
        'password' => bcrypt('password'), // Provide appropriate password
        'address' => $student->address,
                    'city' => $student->city,
                    'state' => $student->state, //'FL',  // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $student->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
    ]);

    // Assign parent role
    $parentUser->assignRole($parentRole);
//}

//dd($parentUser->id);

// Fetch the user by ID
//$user = User::find($id);

if ($student) {
    // Update the name field by combining fname and lname
    $student->name = $student->fname . ' ' . $student->lname;
    
    // Save the changes
    $student->save();
}

if ($them) {
    // Update the name field by combining fname and lname
    $them->parent_id = $parentUser->id;
    
    // Save the changes
    $them->save();
}

//dd($them,$student,$them->parent_id);


}






//dd($data,$student);
}


//dd($parents,$teachers,$students);

/*
//////////////////////////////////

// Check if a parent role exists
$parentRole = Role::where('name', 'parent')->first();
$parentUser = User::role('parent')->first();

if (!$parentUser) {
    // Create new parent user
    $parentUser = User::create([
        'name' => 'Parent User', // Provide appropriate name
        'email' => 'parent@example.com', // Provide appropriate email
        'password' => bcrypt('password'), // Provide appropriate password
    ]);

    // Assign parent role
    $parentUser->assignRole($parentRole);
}




//////////////////////////////////////////

*/








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

         if ($user->hasRole('student')) {
            $student= Student::where('user_id', $user->id)
            ->with('classrooms')
            ->get();
               //->with('parents')
         //dd($student,$user);

             return view('dashboardstudent', compact('teachers', 'user','schoolName','student'));
        }

$studentinnfo= '';



        return view('dashboard', compact('teachers', 'user','schoolName','students'));
    
    }

}
