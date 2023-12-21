<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [ "name" =>"Dep.Informatico", "created_at"=>now()],
            [ "name" =>"Dep.Secretaria", "created_at"=>now()],
            [ "name" => "Dep.Formación y Orientación Laboral)", "created_at" => now() ],
            [ "name" => "Dep.Química", "created_at" => now() ],
            [ "name" => "Dep.Marketing", "created_at" => now() ],
            [ "name" => "Dep.Gestión Administrativa", "created_at" => now() ],
            [ "name" => "Dep.Electricidad", "created_at" => now() ],
            [ "name" => "Dep.Automoción", "created_at" => now() ],
        ]);
    }
}
