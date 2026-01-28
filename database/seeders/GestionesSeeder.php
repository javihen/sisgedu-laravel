<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GestionesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('gestiones')->insert([
            [
                'anio' => 2000,
                'fechaI' => now(),
                'fechaF' => now(),
                'estado' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
