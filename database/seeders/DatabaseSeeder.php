<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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


        $faker = Faker::create();
        $schools = DB::table('schools')->where('county', 'Broward County')->get();

        foreach ($schools as $school) {
            for ($i = 0; $i < 10; $i++) {
                $teacher = User::create([
                    'name' => $faker->name,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'), // Change 'password' to the desired password
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => 'FL', //$faker->stateAbbr, // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $school->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
                    'updated_at' => now(),
                    'school_id' => $school->id,
                ]);
                $teacher->assignRole('teacher');
                $student = User::create([
                    'name' => $faker->name,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'), // Change 'password' to the desired password
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => 'FL', //$faker->stateAbbr, // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $school->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
                    'updated_at' => now(),
                    'school_id' => $school->id,
                ]);
                $student->assignRole('student');


            }


        }




        $schools = DB::table('schools')
            ->where('county', 'Warren County')
            ->where('state', 'NJ')
            ->get();
        foreach ($schools as $school) {
            for ($i = 0; $i < 10; $i++) {
                $teacher = User::create([
                    'name' => $faker->name,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'), // Change 'password' to the desired password
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => 'FL', //$faker->stateAbbr, // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $school->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
                    'updated_at' => now(),
                    'school_id' => $school->id,
                ]);
                $teacher->assignRole('teacher');
                $student = User::create([
                    'name' => $faker->name,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'), // Change 'password' to the desired password
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => 'FL', //$faker->stateAbbr, // Generates a two-letter state abbreviation (e.g., "CA" for California)
                    'zip' => $school->zip, //$faker->postcode, // Generates a ZIP code (e.g., "12345")
                    'created_at' => now(),
                    'updated_at' => now(),
                    'school_id' => $school->id,
                ]);
                $student->assignRole('student');



            }
        }

    }
}
