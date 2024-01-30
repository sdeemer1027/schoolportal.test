<?php

namespace App\Http\Controllers;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentInfoController extends Controller
{
    public function index()
    {
 $user = Auth::user(); // Get the currently logged-in user
        // Fetch and return all student information
//        $studentInfos = StudentInfo::all();
//        $studentInfos = StudentInfo::with('teacher')->get();
//        $studentInfos = StudentInfo::with('teacher.user')->get();
        $studentInfos = StudentInfo::with('teacher.user')->where('user_id',$user->id)->get();

//        dd($user,$studentInfos);

        return view('student_info.index', compact('studentInfos'));
    }

    // Add other CRUD methods (create, update, delete) as needed


}
