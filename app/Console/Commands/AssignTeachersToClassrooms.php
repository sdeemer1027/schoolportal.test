<?php
// AssignTeachersToClassrooms.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Teacher;
use App\Models\Classroom;

class AssignTeachersToClassrooms extends Command
{
    protected $signature = 'assign:teachers-to-classrooms';
    protected $description = 'Assign teachers to classrooms in the database';

    public function handle()
    {
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        foreach ($teachers as $teacher) {
            $classroom = $classrooms->random(); // Assign a random classroom to the teacher
            $classroom->teachers()->attach($teacher->id);
        }

        $this->info('Teachers assigned to classrooms successfully.');
    }
}
