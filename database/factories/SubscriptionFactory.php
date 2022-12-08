<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Subscription::class;
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'tipe_pyment' => $this->faker->randomElement(['mensual', 'anual']),
        ];
    }
}
