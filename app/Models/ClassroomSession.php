<?php

// app/Models/ClassroomSession.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomSession extends Model
{
    protected $fillable = [
        'teacher_id', 'student_id', 'session_datetime',
        // Add other fields like attendance, GPA, test scores, etc.
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
