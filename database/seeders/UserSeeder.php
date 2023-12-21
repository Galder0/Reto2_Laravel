<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('SET @@auto_increment_increment=0;');
        DB::statement('SET @@auto_increment_offset=1;');
        DB::statement('SET sql_mode="NO_AUTO_VALUE_ON_ZERO";');

        // Seed roles
        $this->call(RoleSeeder::class);

        // Get the 'admin', 'student', and 'teacher' roles
        $adminRole = Role::where('name', 'admin')->first();
        $studentRole = Role::where('name', 'student')->first();
        $teacherRole = Role::where('name', 'teacher')->first();

        // Create a user with a custom ID (e.g., 0)
        DB::table('users')->insert([
            'id' => 0,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => null,
        ]);

        // Attach the 'admin' role to the admin user
        DB::table('roles_users')->insert([
            'role_id' => $adminRole->id,
            'user_id' => 0,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::statement('SET @@auto_increment_increment=1;');
        DB::statement('SET @@auto_increment_offset=2;');
        DB::statement('SET sql_mode="";');

        
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

