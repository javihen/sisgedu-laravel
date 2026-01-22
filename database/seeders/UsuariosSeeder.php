<?php

// database/seeders/UsuariosSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            'username' => 'ADMIN',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'estado' => 1,
            'idRol' => 1,
            'id_profesor' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
