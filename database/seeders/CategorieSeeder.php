<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =['refrigerator','stove','microwave', 'Iron', 'washing machine'];
        for($i=0; $i<5; $i++)
        {
            Categorie::create([
                'name'=>$categories[$i]
            ]);
        }
    }
}
