<?php

namespace App\Http\Controllers;
use App\Models\StudentInfo;
use Illuminate\Http\Request;

class StudentInfoController extends Controller
{
    public function index()
    {
        // Fetch and return all student information
        $studentInfos = StudentInfo::all();
        return view('student_info.index', compact('studentInfos'));
    }

    // Add other CRUD methods (create, update, delete) as needed

    
}
