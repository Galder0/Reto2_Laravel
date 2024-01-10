<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call(DepartmentSeeder::class);
        // Seed users
        $this->call(UserSeeder::class);

        $this->call(CycleSeeder::class);

        $this->call(ModuleSeeder::class);

        $this->call(CyclesModulesSeeder::class);
        
    }
}
