<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassroomScheduleSeeder extends Seeder
{
    public function run()
    {
        // Get current classrooms and schools
        $classrooms = DB::table('classrooms')->get();
        $schools = DB::table('schools')->get(); // Assuming you have a 'schools' table
        $teachers = DB::table('users')->where('role', 'teacher')->get(); // Get teachers
        $students = DB::table('users')->where('role', 'student')->get(); // Get students

        foreach ($classrooms as $classroom) {
            foreach ($schools as $school) {
                foreach ($teachers as $teacher) {
                    foreach ($students as $student) {
                        DB::table('classroom_schedules')->insert([
                            'classroom_id' => $classroom->id,
                            'school_id' => $school->id,
                            'teacher_id' => $teacher->id,
                            'student_id' => $student->id,
                            'schedule_time' => now()->addHours(rand(1, 6))->format('H:i:s'), // Example time
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
