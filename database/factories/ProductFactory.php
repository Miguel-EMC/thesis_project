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
            'user_id' => random_int(6, 20),
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'detail' => $this->faker->paragraph,
            'stock' => $this->faker->randomDigit,
            'state_appliance' => $this->faker->randomElement(['nuevo', 'usado', 'reacondicionado', 'reparado', 'reacondicionado']),
            'delivery_method' => $this->faker->randomElement(['delivery', 'pickup']),
            'brand' => $this->faker->randomElement(['samsung', 'lg', 'sony', 'philips', 'panasonic', 'toshiba', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire']),
            'image'=> $this->faker->randomElement([
                'https://www.ideal.es/multimedia/202101/13/media/granada/marcas-electrodomesticos-duraderas-fiables-ocu.jpg',
                'https://kissu.com.ec/imagenes/subcategorias/1659549117.jpg',
                'https://blog.enalquiler.com/files/2019/02/Electrodomesticos.jpg',
                'https://decortips.com/es/wp-content/uploads/2021/06/prolongar-la-vida-de-los-electrodomesticos-768x512.jpg',
                'https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2016/11/208636-black-friday-mejores-ofertas-comprar-electrodomesticos.jpg',
                'https://http2.mlstatic.com/D_NQ_NP_604261-MEC52681445101_122022-O.webp',
                'https://http2.mlstatic.com/D_NQ_NP_2X_663012-MEC52197504419_102022-F.webp',
                'https://img.freepik.com/fotos-premium/electrodomesticos-cocina-gas-tv-cine-refrigerador-aire-acondicionado-microondas-computadora-portatil-lavadora_252025-693.jpg',
                'https://img.freepik.com/fotos-premium/grupo-electrodomesticos-sobre-fondo-rosa-studio_241146-976.jpg',
                'https://www.nationalgeographic.com.es/medio/2021/06/01/el-consumo-electrico-puede-controlarse-siguiendo-algunos-simples-consejos_91e86f03_1280x640.jpg'
            ])
        ];
    }
}
