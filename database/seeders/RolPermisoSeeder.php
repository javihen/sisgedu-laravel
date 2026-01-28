<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolPermisoSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('rol_permiso')->insert([
            [
                'idRol' => 1,
                'idPermiso' => 1,
            ],
        ]);
    }
}
