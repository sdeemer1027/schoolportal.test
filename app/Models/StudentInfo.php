<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;
    // , SoftDeletes;


    protected $fillable = [
        'user_id', 'classroom', 'days_and_times', 'teacher_id', 'grade',
    ];

    // Define relationships if needed
}
