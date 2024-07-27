<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Traits\HasRoles;
use App\Models\School;
use App\Models\Zipcode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClassroomStudent;
use App\Models\ClassroomSchedule;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{


public function testassing(Request $request)
{
   
   //, Student $student, Classroom $classroom
   $student =$request['student_id'] ;
   $classroom =$request['classroom_id'];

//$school =


//$request->validate([
//        'classroom_id' => 'required|exists:classrooms,id',
//    ]);

    // Attach the student to the selected classroom
 //   $student->classrooms()->attach($classroom->id);
   $school_id = $request->school_id;

//dd($request,$student,$classroom,$school_id);
 // Insert the student-classroom relationship directly into the classroom_student table
        //DB::table('classroom_student')->
$findstu = Student::where('user_id' , $student)->first();
//dd($findstu);

if(!$findstu){
    // Create a new student
   $student = Student::create([  
    'user_id' => $student,
    'school_id' => $school_id,
   ]);

   $findstu = Student::where('user_id' , $student)->first();
ClassroomStudent::insert([
            'student_id' => $student->id, //$student,
            'classroom_id' => $classroom,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

}

//dd($findstu);

//$findstu2 =ClassroomStudent::where('student_id' , $findstu->id)->first();

//if(!$findstu2){

//    ClassroomStudent::insert([
//            'student_id' => $student->id, //$student,
//            'classroom_id' => $classroom,
//            'created_at' => now(),
//           'updated_at' => now(),
//        ]);
//}





/*
if($findstu2->student_id == $findstu->id){
//dd($findstu2->student_id,$findstu->id);
 return redirect()->back()->with('success', 'already has an id and a classroom');
}else{
    //as he has a classroom we can check if he has an id
  if($findstu->user_id == $student){
  return redirect()->back()->with('success', 'already has an id and a classroom');
     // dd($findstu,$findstu2->student_id); 
      }else{
      

 }

}
*/

 return redirect()->back()->with('success', 'Student assigned to classroom successfully.');


}

public function assignStudentToClassroom(Request $request, Student $student, Classroom $classroom)
{
   dd($request);

    // Validate the request to ensure classroom_id is provided
    $request->validate([
        'classroom_id' => 'required|exists:classrooms,id',
    ]);

    // Attach the student to the selected classroom
    $student->classrooms()->attach($classroom->id);

    return redirect()->back()->with('success', 'Student assigned to classroom successfully.');
}






    public function hireTeacher()
    {
        // Implement logic to hire a teacher
        // For example:
        $teacher = Teacher::create([
            // Add teacher details
        ]);

        return redirect()->back()->with('success', 'Teacher hired successfully.');
    }

    public function assignTeacherToClassroom(Teacher $teacher, Classroom $classroom)
    {
        // Implement logic to assign a teacher to a classroom
        $teacher->classrooms()->attach($classroom->id);

        return redirect()->back()->with('success', 'Teacher assigned to classroom successfully.');
    }

  

public function getschool($id){
  $user = Auth::user(); // Get the currently logged-in user
  $schools = School::where('id',$id)->First();
  $teachers = Teacher::where('school_id','=',$schools->id)->with('user','classrooms')->paginate(10);
  $students = Student::where('school_id','=',$schools->id)->with('user','classrooms')->get();
//dd($schools);

  $classrooms =Classroom::where('school_id','=',$schools->id)->get();
      // Check if the school has less than 25 classrooms
           if ($classrooms->count() < 25) {
               // Calculate the number of classrooms to add
               $classroomsToAdd = 25 - $classrooms->count();
            // Define the schedule times and their names
            $scheduleTimes = [
                '08:00' => 'HomeRoom',
                '08:15' => 'first',
                '09:15' => 'second',
                '10:15' => 'third',
                '11:15' => 'fourth',
                '12:15' => 'Lunch',
                '13:00' => 'fifth',
                '14:00' => 'sixth',
                '15:00' => 'seventh'
            ];

            // Add the necessary number of classrooms
            for ($i = 0; $i < $classroomsToAdd; $i++) {
                $classroom = Classroom::create([
                    'school_id' => $id,
                ]);

// Create schedules for the new classroom
                foreach ($scheduleTimes as $time => $name) {
//dd($scheduleTimes, $time, $name);
                     ClassroomSchedule::create([
                        'classroom_id' => $classroom->id,
                        'school_id' => $id,
                        'name' => $name,
                        'schedule_time' => $time
                    ]);
                }

$faker = Faker::create();
$teacherUser = User::create([
                    'name' => $faker->name,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'), // Change 'password' to the desired password
                    'address' => $faker->streetAddress,
                    'city' => $schools->city,
                    'state' => $schools->state, //'FL',  // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $schools->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
                    'updated_at' => now(),
                    'school_id' => $id,
                ]);
                $teacherUser->assignRole('teacher');
               
 $teacher = Teacher::create([
                'user_id'   => $teacherUser->id,
                'school_id' => $teacherUser->school_id,
                // Add other fields as needed
            ]);

            // Attach the teacher to the classroom_teacher pivot table
            $teacher->classrooms()->attach($classroom->id);


        // Update the classroom schedule with the teacher ID
        ClassroomSchedule::where('classroom_id', $classroom->id)
            ->update(['teacher_id' => $teacher->id]);

//dd($teacher->id,$classroom);


            }

        }




 return view('admin.getschool', compact('user','schools','teachers','classrooms'));
  }



 public function findschool($stateabv){
    $user = Auth::user(); // Get the currently logged-in user
    $schools = School::where('state',$stateabv)->paginate(10); //->get();

     return view('admin.schoolsbystate', compact('user','schools'));
 }

 public function schools(){

$user = Auth::user(); // Get the currently logged-in user
    $roles = $user->roles; // Retrieve the roles of the user
    foreach($roles as $role){
    
    }  
    if($role->name == 'admin'){
//        $schools = School::where('state','FL')->get();

//        $states= Zipcode::select('statename', 'stateabv')
//            ->groupBy('statename', 'stateabv')
//            ->get(); 
 /*
$states = Zipcode::select('zipcodes.statename', 'zipcodes.stateabv')
    ->join('schools', 'schools.zip', '=', 'zipcodes.id')
    ->groupBy('zipcodes.statename', 'zipcodes.stateabv')
    ->havingRaw('COUNT(schools.id) > 0')
    ->orderBy('zipcodes.statename')
    ->get();


$states = \DB::table('schools')
    ->select('state')
    ->groupBy('state')
    ->orderBy('state')
    ->get();

$states = DB::table('schools')
    ->join('zipcodes', 'schools.zip', '=', 'zipcodes.id') // Adjust this join condition as necessary
    ->select('zipcodes.statename', 'zipcodes.stateabv')
    ->groupBy('zipcodes.statename', 'zipcodes.stateabv')
    ->orderBy('zipcodes.statename')
    ->get();
*/

$states = DB::table('schools')
    ->join('zipcodes', 'schools.zip', '=', 'zipcodes.id') // Adjust this join condition as necessary
    ->select('zipcodes.statename', 'zipcodes.stateabv', DB::raw('COUNT(schools.id) as school_count'))
    ->groupBy('zipcodes.statename', 'zipcodes.stateabv')
    ->orderBy('zipcodes.statename')
    ->get();



 return view('admin.index', compact('user','roles','states'));
    }else{
     dd($roles , $role->name);
    }
 }






public function getclassroom($id)
{
    // Retrieve the classroom and its teachers
    $classroom = Classroom::where('id', '=', $id)->with('teachers')->first();
    $teachers = Teacher::where('user_id', '=', $classroom->teachers[0]->user_id)->with('user', 'classrooms')->get();

    // Get the school ID from the teacher's information
    $schoolid = $classroom->teachers[0]->school_id;

    // Retrieve all students in the school
    $allStudents = User::whereHas('roles', function ($query) {
        $query->where('name', 'student');
    })
    ->where('school_id', $schoolid)
    ->leftJoin('schools', 'users.school_id', '=', 'schools.id') // Join the schools table
    ->select('users.*', 'schools.name as school_name') // Select the school name as 'school_name'
    ->get();

    // Retrieve the students assigned to the specified classroom as HomeRoom
    $classroomStudents = Student::whereHas('classrooms', function ($query) use ($id) {
        $query->where('classroom_id', $id);
    })->get();

    // Check if there are fewer than 10 students in the classroom
    if ($classroomStudents->count() < 10) {
        $studentsToAdd = 10 - $classroomStudents->count();
        $faker = Faker::create();

        // Add the necessary number of fake students
        for ($i = 0; $i < $studentsToAdd; $i++) {
            $studentUser = User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'fname' => $faker->firstName,
                'lname' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Change 'password' to the desired password
                'address' => $faker->streetAddress,
                'city' => 'any',
                'state' => 'FL',
                'zip' => '33020',
                'created_at' => now(),
                'updated_at' => now(),
                'school_id' => $schoolid,
            ]);
            $studentUser->assignRole('student');

            $student = Student::create([
                'user_id' => $studentUser->id,
                'school_id' => $studentUser->school_id,
                'parent_id' => null,
                'current_grade' => 'N/A',
                'current_gpa' => 'N/A',
            ]);

            // Attach the student to the classroom
            $student->classrooms()->attach($classroom->id);

            // Create the HomeRoom schedule for the fake student
            ClassroomSchedule::updateOrCreate(
                [
                    'classroom_id' => $classroom->id,
                    'school_id' => $studentUser->school_id,
                    'name' => 'HomeRoom',
                    'schedule_time' => '08:00',
                ],
                [
                    'student_id' => $student->id,
                    'teacher_id' => $classroom->teachers[0]->id
                ]
            );
        }

        // Refresh the classroom students list to include the newly added students
        $classroomStudents = Student::whereHas('classrooms', function ($query) use ($id) {
            $query->where('classroom_id', $id);
        })->with('user')->get();
    }

//dd($classroomStudents,$allStudents);



    return view('admin.getclassroom', compact('classroom', 'teachers', 'allStudents', 'classroomStudents'));
}







  public function editteacher(Teacher $teacher)
    {


$data = User::where('id', $teacher->user_id)->first();
//dd($teacher,$data);

        return view('admin.teachers.edit', compact('teacher','data'));
    }

    public function updateteacher(Request $request, Teacher $teacher)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $teacher->user_id, // Assuming user_id is the foreign key
            'phone' => 'nullable|string|max:20',
            // Add other validation rules as needed
        ]);

        // Update the teacher information
//        $teacher->name = $request->name;
//        $teacher->phone = $request->phone;
//        $teacher->save();

        // Update the associated user's email
        $user = $teacher->user; // Assuming there's a user relationship defined in the Teacher model
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

     return redirect()->route('dashboard')->with('success', 'Teacher information updated successfully.');
      //  return redirect()->route('admin.teachers.edit', $teacher)->with('success', 'Teacher information updated successfully.');
    }



}
