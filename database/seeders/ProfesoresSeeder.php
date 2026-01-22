<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('profesores')->insert([
            'id_profesor' => '1',
            'ci' => '123456',
            'rda' => '0',
            'nombres' => 'ADMIN',
            'appaterno' => 'ISTRADOR',
            'apmaterno' => '.',
            'genero' => 'M',
            'fechaNac' => now(),
            'fuenteFinan' => 'PPFF',
            'nivelFormacion' => 'LICENCIATURA',
            'estado' => 'A',
            'observacion' => 'NINGUNA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
