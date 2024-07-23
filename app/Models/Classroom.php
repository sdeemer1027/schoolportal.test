<?php
// Classroom.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    // ... other model code

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'classroom_teacher');
    }

    // ... other model code

    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_students');
    }

//     public function students()
//    {
//        return $this->belongsToMany(Student::class, 'classroom_students');
//    }
}
