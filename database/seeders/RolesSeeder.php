<?php

// database/seeders/RolesSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'idRol' => 1,
                'nombreRol' => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRol' => 2,
                'nombreRol' => 'profesor',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
