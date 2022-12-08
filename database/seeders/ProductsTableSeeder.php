<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla Products
        Product::truncate();
        $faker = \Faker\Factory::create();

        // Crear productos ficticios en la tabla
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'title' => $faker->sentence,
                'price_min' => $faker->randomFloat(2, 1, 100),
                'price_max' => $faker->randomFloat(2, 1, 100),
                'detail' => $faker->paragraph,
                'stock' => $faker->randomDigit,
                'state_appliance' => $faker->randomElement(['nuevo', 'usado']),
                'delivery_method' => $faker->randomElement(['retiro en tienda', 'envio a domicilio']),
                'brand' => $faker->randomElement(['Sony', 'Motorola', 'eld'])
            ]);
        }
    }
}
