<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomTeacher extends Model
{
    use HasFactory;



     // Define the inverse of the relationship if necessary
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    
}
