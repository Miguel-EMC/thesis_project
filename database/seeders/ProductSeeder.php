<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_refrigerator= Categorie::where('name', 'refrigerator')->first();
        // 5 productos que le pertenecen a la categoria refrigerator
        Product::factory()->for($categories_refrigerator)->count(20)->create();

        $categories_stove= Categorie::where('name', 'stove')->first();
        // 5 productos que le pertenecen a la categoria stove
        Product::factory()->for($categories_stove)->count(20)->create();

        $categories_microwave= Categorie::where('name', 'microwave')->first();
        // 5 productos que le pertenecen a la categoria microwave
        Product::factory()->for($categories_microwave)->count(20)->create();

        $categories_Iron= Categorie::where('name', 'Iron')->first();
        // 5 productos que le pertenecen a la categoria Iron
        Product::factory()->for($categories_Iron)->count(20)->create();

        $categories_washing_machine= Categorie::where('name', 'washing machine')->first();
        // 5 productos que le pertenecen a la categoria washing machine
        Product::factory()->for($categories_washing_machine)->count(5)->create();
    }
}