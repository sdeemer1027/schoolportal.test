<?php

// app/Http/Controllers/ClassroomSessionController.php

namespace App\Http\Controllers;

use App\Models\ClassroomSession;
use Illuminate\Http\Request;

class ClassroomSessionController extends Controller
{
    public function index()
    {
        // Fetch and return all classroom sessions
        $classroomSessions = ClassroomSession::all();
        return view('classroom_sessions.index', compact('classroomSessions'));
    }

    // Add other methods for creating, updating, deleting, etc.
}
