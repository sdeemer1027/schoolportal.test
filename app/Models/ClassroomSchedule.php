<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomSchedule extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'classroom_schedules';

    // Define the fillable properties
    protected $fillable = [
        'classroom_id',
        'school_id',
        'teacher_id',
        'student_id',
        'schedule_time',
        'name',
    ];

    // Define the relationships if needed
//    public function classroom()
//    {
//        return $this->belongsTo(Classroom::class);
//    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_schedule_student', 'schedule_id', 'student_id');
    }


  // Define the relationship with Student if a many-to-many relationship exists
 //   public function students()
  //  {
 //       return $this->belongsToMany(Student::class, 'classroom_schedule_student', 'classroom_schedule_id', 'student_id');
 //   }

    // Define the relationship with Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }




}
