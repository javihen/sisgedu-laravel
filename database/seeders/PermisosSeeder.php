<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permisos')->insert([
            [
                'idPermiso' => 1,
                'nombrePermiso' => 'gestionar_roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPermiso' => 2,
                'nombrePermiso' => 'ver_materias',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPermiso' => 3,
                'nombrePermiso' => 'ver_estudiantes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPermiso' => 4,
                'nombrePermiso' => 'ver_profesores',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPermiso' => 5,
                'nombrePermiso' => 'ver_cursos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
