<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CyclesModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into cycles_modules table
        DB::table('cycles_modules')->insert([
            // Modules for "TÉCNICO EN SISTEMAS MICROINFORMÁTICOS Y REDES"
            ["cycle_id" => 1, "module_id" => 1],
            ["cycle_id" => 1, "module_id" => 2],
            ["cycle_id" => 1, "module_id" => 3],
            ["cycle_id" => 1, "module_id" => 4],
            ["cycle_id" => 1, "module_id" => 5],
            ["cycle_id" => 1, "module_id" => 6],
            ["cycle_id" => 1, "module_id" => 7],
            ["cycle_id" => 1, "module_id" => 8],
            ["cycle_id" => 1, "module_id" => 9],
            ["cycle_id" => 1, "module_id" => 10],
            ["cycle_id" => 1, "module_id" => 11],
            ["cycle_id" => 1, "module_id" => 12],

            // Modules for "TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES MULTIPLATAFORMA"
            ["cycle_id" => 2, "module_id" => 13],
            ["cycle_id" => 2, "module_id" => 14],
            ["cycle_id" => 2, "module_id" => 15],
            ["cycle_id" => 2, "module_id" => 16],
            ["cycle_id" => 2, "module_id" => 17],
            ["cycle_id" => 2, "module_id" => 18],
            ["cycle_id" => 2, "module_id" => 19],
            ["cycle_id" => 2, "module_id" => 20],
            ["cycle_id" => 2, "module_id" => 21],
            ["cycle_id" => 2, "module_id" => 22],
            ["cycle_id" => 2, "module_id" => 23],
            ["cycle_id" => 2, "module_id" => 24],
            ["cycle_id" => 2, "module_id" => 25],
            ["cycle_id" => 2, "module_id" => 26],
            ["cycle_id" => 2, "module_id" => 27],

            // Modules for "TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES WEB"
            ["cycle_id" => 3, "module_id" => 28],
            ["cycle_id" => 3, "module_id" => 29],
            ["cycle_id" => 3, "module_id" => 30],
            ["cycle_id" => 3, "module_id" => 31],
            ["cycle_id" => 3, "module_id" => 32],
            ["cycle_id" => 3, "module_id" => 33],
            ["cycle_id" => 3, "module_id" => 34],
            ["cycle_id" => 3, "module_id" => 35],
        ]);
    }
}
