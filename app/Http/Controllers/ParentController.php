<?php

namespace App\Http\Controllers;


//use App\Models\Parent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;


class ParentController extends Controller
{
    public function show($id)
    {
        // Retrieve the parent and related data
        $parent = Parent::findOrFail($id);
        // You can load relationships if needed: $parent->load('students', 'teachers');

        return view('parents.show', compact('parent'));
    }

    public function manageStudents($id)
    {
        // Logic for managing students associated with a parent
    }

    public function manageTeachers($id)
    {
        // Logic for managing teachers associated with a parent
    }



 public function showFamily(Request $request)
    {
        $parentId =  auth()->user()->id; // Assuming the parent is the authenticated user


    $parentId = 10287;
//
/*
        // Fetch students associated with the parent
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->where('parent_id', $parentId)->with('homeroomTeacher')->get();

*/



$students ='';

   $students = Student::where('parent_id', $parentId)->get();



        return view('parent.family', compact('students'));
    }









}
