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

   
}
