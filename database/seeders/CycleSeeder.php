<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cycles')->insert([
            ["name"=>"TÉCNICO EN SISTEMAS MICROINFORMÁTICOS Y REDES", "code"=>"0111",  'department_id' => 1, "created_at"=>now()],
            ["name"=>"TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES MULTIPLATAFORMA", "code"=>"0222", 'department_id' => 1, "created_at"=>now()],
            ["name"=>"TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES WEB", "code"=>"0333", 'department_id' => 1, "created_at"=>now()]
        ]);
    }
}
