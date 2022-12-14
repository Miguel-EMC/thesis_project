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
    public function definition()
    {
        return [
            'user_id' => random_int(5, 20),
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'detail' => $this->faker->paragraph,
            'stock' => $this->faker->randomDigit,
            'state_appliance' => $this->faker->randomElement(['nuevo', 'usado', 'reacondicionado', 'reparado', 'reacondicionado']),
            'delivery_method' => $this->faker->randomElement(['delivery', 'pickup']),
            'brand' => $this->faker->randomElement(['samsung', 'lg', 'sony', 'philips', 'panasonic', 'toshiba', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire']),
        ];
    }
}
