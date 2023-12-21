<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            //MODULOS DEL PRIMER CICLO (SMR)
            ["code"=>"0221", "name"=>"Montaje y mantenimiento de equipos",  "numberHours"=>"231", "year"=>"1", "created_at"=>now()],
            ["code"=>"0222", "name"=>"Sistemas operativos monopuesto",      "numberHours"=>"165", "year"=>"1", "created_at"=>now()],
            ["code"=>"0223", "name"=>"Aplicaciones ofimáticas",             "numberHours"=>"231", "year"=>"1", "created_at"=>now()],
            ["code"=>"0224", "name"=>"Sistemas operativos en red",          "numberHours"=>"168", "year"=>"2", "created_at"=>now()],
            ["code"=>"0225", "name"=>"Redes locales",                       "numberHours"=>"231", "year"=>"1", "created_at"=>now()],
            ["code"=>"0226", "name"=>"Seguridad informática",               "numberHours"=>"99",  "year"=>"1", "created_at"=>now()],
            ["code"=>"0227", "name"=>"Servicios en red",                    "numberHours"=>"189", "year"=>"2", "created_at"=>now()],
            ["code"=>"0228", "name"=>"Aplicaciones web",                    "numberHours"=>"105", "year"=>"2", "created_at"=>now()],
            ["code"=>"0100", "name"=>"Inglés técnico",                      "numberHours"=>"33",  "year"=>"1", "created_at"=>now()],
            ["code"=>"0229", "name"=>"Formación y Orientación Laboral",     "numberHours"=>"105", "year"=>"2", "created_at"=>now()],
            ["code"=>"0239", "name"=>"Empresa e Iniciativa Emprendedora",   "numberHours"=>"63",  "year"=>"2", "created_at"=>now()],
            ["code"=>"0231", "name"=>"Formación en Centros de Trabajo",     "numberHours"=>"380", "year"=>"2", "created_at"=>now()],

            //MODULOS DEL SEGUNDO CICLO (DAM)
            ["code"=>"0483", "name"=>"Sistemas informáticos",                                       "numberHours"=>"165",   "year"=>"1", "created_at"=>now()],
            ["code"=>"0484", "name"=>"Bases de datos",                                              "numberHours"=>"198",   "year"=>"1", "created_at"=>now()],
            ["code"=>"0485", "name"=>"Programación",                                                "numberHours"=>"264",   "year"=>"1", "created_at"=>now()],
            ["code"=>"0373", "name"=>"Lenguajes de marcas y sistemas de gestión de información",    "numberHours"=>"132",   "year"=>"1", "created_at"=>now()],
            ["code"=>"0487", "name"=>"Entornos de desarrollo ",                                     "numberHours"=>"99",    "year"=>"1", "created_at"=>now()],
            ["code"=>"0486", "name"=>"Acceso a datos",                                              "numberHours"=>"120",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0488", "name"=>"Desarrollo de interfaces",                                    "numberHours"=>"140",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0489", "name"=>"Programación multimedia y dispositivos móviles",              "numberHours"=>"100",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0490", "name"=>"Programación de servicios y procesos",                        "numberHours"=>"80",    "year"=>"2", "created_at"=>now()],
            ["code"=>"0491", "name"=>"Sistemas de gestión empresarial ",                            "numberHours"=>"100",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0492", "name"=>"Proyecto de desarrollo de aplicaciones multiplataforma",      "numberHours"=>"50",    "year"=>"2", "created_at"=>now()],
            ["code"=>"0200", "name"=>"Inglés Técnico",                                              "numberHours"=>"33",    "year"=>"1", "created_at"=>now()],
            ["code"=>"0493", "name"=>"Formación y Orientación Labora",                              "numberHours"=>"99",    "year"=>"1", "created_at"=>now()],
            ["code"=>"0494", "name"=>"Empresa e Iniciativa Emprendedora",                           "numberHours"=>"60",    "year"=>"2", "created_at"=>now()],
            ["code"=>"0495", "name"=>"Formación en Centros de Trabajo",                             "numberHours"=>"360",   "year"=>"2", "created_at"=>now()],

            //MODULOS DEL TERCER CICLO (DAW)
            ["code"=>"0612", "name"=>"Desarrollo web en entorno cliente",           "numberHours"=>"140",  "year"=>"2", "created_at"=>now()],
            ["code"=>"0613", "name"=>"Desarrollo web en entorno servidor",          "numberHours"=>"180",  "year"=>"2", "created_at"=>now()],
            ["code"=>"0614", "name"=>"Despliegue de aplicaciones web",              "numberHours"=>"100",  "year"=>"2", "created_at"=>now()],
            ["code"=>"0615", "name"=>"Diseño de interfaces web",                    "numberHours"=>"120",  "year"=>"2", "created_at"=>now()],
            ["code"=>"0616", "name"=>"Proyecto de desarrollo de aplicaciones web",  "numberHours"=>"50",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0617", "name"=>"Formación y Orientación Laboral",             "numberHours"=>"99",   "year"=>"1", "created_at"=>now()],
            ["code"=>"0618", "name"=>"Empresa e Iniciativa Emprendedora",           "numberHours"=>"60",   "year"=>"2", "created_at"=>now()],
            ["code"=>"0619", "name"=>"Formación en Centros de Trabajo",             "numberHours"=>"360",  "year"=>"2", "created_at"=>now()],
        ]);
    }
}
