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
        $imagen = [
            'https://www.ideal.es/multimedia/202101/13/media/granada/marcas-electrodomesticos-duraderas-fiables-ocu.jpg',
            'https://kissu.com.ec/imagenes/subcategorias/1659549117.jpg',
            'https://blog.enalquiler.com/files/2019/02/Electrodomesticos.jpg',
            'https://decortips.com/es/wp-content/uploads/2021/06/prolongar-la-vida-de-los-electrodomesticos-768x512.jpg',
            'https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2016/11/208636-black-friday-mejores-ofertas-comprar-electrodomesticos.jpg'];

        for($i=0; $i<5; $i++)
        {
            Categorie::create([
                'name'=>$categories[$i],
                'imagen'=>$imagen[$i]
            ]);
        }
    }
}
