<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed roles
        $this->call(RoleSeeder::class);

        // Get the 'student' and 'teacher' roles
        $studentRole = Role::where('name', 'student')->first();
        $teacherRole = Role::where('name', 'teacher')->first();

        // Create 1000 users with the 'student' role
        User::factory(1000)->create()->each(function ($user) use ($studentRole) {
            $user->roles()->attach($studentRole);
        });

        // Create 80 users with the 'teacher' role
        User::factory(80)->create()->each(function ($user) use ($teacherRole) {
            $user->roles()->attach($teacherRole);
        });
    }
}
