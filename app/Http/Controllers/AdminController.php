<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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

    public function assignStudentToClassroom(Student $student, Classroom $classroom)
    {
        // Implement logic to assign a student to a classroom
        $student->classrooms()->attach($classroom->id);

        return redirect()->back()->with('success', 'Student assigned to classroom successfully.');
    }
    public function schools(){

$user = Auth::user(); // Get the currently logged-in user




        return view('admin.index', compact('user'));
    }
}
