<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // $faker = \Faker\Factory::create();
        // // Crear la misma clave para todos los usuarios
        // // La clave se debe hash
        // $password = Hash::make('secreto');
        // // Generar algunos usuarios para nuestra aplicacion
        // User::create([
        //     'username' => 'Administrador',
        //     'first_name' => 'Administrador',
        //     'last_name' => 'Administrador',
        //     'personal_phone' => '0999763190',
        //     'home_phone' => '2787676',
        //     'address' => 'Calle 1',
        //     'email' => 'admin@example.com',
        //     'password' => $password,
        // ]);
        // Generar algunos usuarios para nuestra aplicacion

        $rol_admin = Role::where('name', 'admin')->first();
        User::factory()->for($rol_admin)->count(5)->create();

        $rol_customer = Role::where('name', 'customer')->first();
        // 5 usuarios que le pertenecen al rol cliente
        // https://laravel.com/docs/9.x/database-testing#belongs-to-relationships
        User::factory()->for($rol_customer)->count(15)->create();
    }
}