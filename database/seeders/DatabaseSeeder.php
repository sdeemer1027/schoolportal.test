<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Create roles
        Role::create(['name' => 'admin']); //Main Admin
        Role::create(['name' => 'employee']); //Admin Employee
        Role::create(['name' => 'superadmin']); //Super intendent of each school
        Role::create(['name' => 'teacher']);  //Teachers
        Role::create(['name' => 'coach']);    //Coaches
        Role::create(['name' => 'counselor']); // Guidance  Counselors
        Role::create(['name' => 'student']);   // Students
        Role::create(['name' => 'parent']);    // Parents


        // Create permissions
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);

       // Assign permissions to roles
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo('create articles', 'edit articles');

        $editorRole = Role::findByName('employee');
        $editorRole->givePermissionTo('edit articles');


        $user = User::create([
            'name'     => 'Dr.Steve',
            'fname'    =>'Steve',
            'lname'    =>'Deemer',
            'phone'    =>'954-391-0398',
            'city'     => 'Hollywood',
            'state'    => 'FL',
            'zip'      =>'33020',
            'email'    => 'dr.steve@steven.news',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('admin');







    }
}
