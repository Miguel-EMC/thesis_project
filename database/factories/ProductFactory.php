<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'price_min' => $this->faker->randomFloat(2, 1, 100),
            'price_max' => $this->faker->randomFloat(2, 1, 100),
            'detail' => $this->faker->paragraph,
            'stock' => $this->faker->randomDigit,
            'state_appliance' => $this->faker->randomElement(['nuevo', 'usado']),
            'delivery_method' => $this->faker->randomElement(['retiro en tienda', 'envio a domicilio']),
            'brand' => $this->faker->randomElement(['Sony', 'Motorola', 'eld'])
        ];
    }
}
