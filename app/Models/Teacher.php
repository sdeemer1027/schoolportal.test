<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    public function parents()
    {
        return $this->belongsToMany(Parent::class, 'parent_teacher', 'teacher_id', 'parent_id');
    }
}
