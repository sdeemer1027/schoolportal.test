<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentInfo extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id', 'classroom', 'days_and_times', 'teacher_id', 'grade',
    ];

      protected $casts = [
        'days_and_times' => 'json',
    ];
 
    public function teacher()
    {
       // return $this->belongsTo(Teacher::class);
      //  return $this->belongsTo(User::class, 'user_id');
//          return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
          return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    // Define relationships if needed


}
