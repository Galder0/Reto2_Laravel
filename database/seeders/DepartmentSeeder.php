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
            //MODULOS DEL PRIMER CICLO (SMR)
            [ "name"=>"Dep.Informatico", "created_at"=>now()],
            [ "name"=>"Dep.Secretaria", "created_at"=>now()]
        ]);
    }
}
