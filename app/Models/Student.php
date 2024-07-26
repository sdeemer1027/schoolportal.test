<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'school_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


     public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_students');
    }
// Define the relationship with ClassroomSchedule if applicable
    public function classroomSchedules()
    {
        return $this->hasMany(ClassroomSchedule::class, 'student_id');
    }

    
/*

    // Define a relationship if students are linked through a pivot table
    public function classroomSchedules()
    {
        return $this->belongsToMany(ClassroomSchedule::class, 'classroom_schedule_student', 'student_id', 'classroom_schedule_id');
    }

    // Define a relationship with Classroom if applicable
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student');
    }
   */
}
