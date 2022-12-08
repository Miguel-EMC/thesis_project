<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla 
        User::truncate();
        $faker = \Faker\Factory::create();
        // Crear la misma clave para todos los usuarios
        // La clave se debe hash
        $password = Hash::make('secreto');
        // Generar algunos usuarios para nuestra aplicacion
        User::create([
            'username' => 'Administrador',
            'first_name' => 'Administrador',
            'last_name' => 'Administrador',
            'personal_phone' => '0999763190',
            'home_phone' => '2787676',
            'address' => 'Calle 1',
            'email' => 'admin@example.com',
            'password' => $password,
        ]);
        // Generar algunos usuarios para nuestra aplicacion
        User::factory()->count(10)->create();
    }
}