<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'school_id',
    ];


    public function parents()
    {
        return $this->belongsToMany(Parent::class, 'parent_teacher', 'teacher_id', 'parent_id');
    }
 public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studentInfos()
    {
        return $this->hasMany(StudentInfo::class, 'teacher_id', 'id');
    }
    
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
