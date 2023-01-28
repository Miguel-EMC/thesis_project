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
            'title' => $this->faker->randomElement([
                "Nueva línea de refrigeradores con tecnología de punta",
                "Lavadoras de carga frontal con eficiencia energética",
                "Horno eléctrico con programas automáticos",
                "Cocinas eléctricas con quemadores de inducción",
                "Aspiradoras de última generación",
                "Microondas con grill y convección",
                "Planchas de ropa con vapor",
                "Licuadoras de alta velocidad",
                "Batidoras con accesorios incluidos",
                "Exprimidores de jugo con filtro",
                "Cafeteras con programación automática",
                "Freidoras sin aceite",
                "Sistemas de sonido inalámbricos",
                "Televisores de pantalla plana",
                "Cámaras de seguridad inteligentes",
                "Sistemas de limpieza automatizados",
                "Secadoras de ropa con tecnología de condensación",
                "Aires acondicionados con control remoto",
                "Sistemas de iluminación inteligentes",
                "Estufas eléctricas con temporizador",
                "Planchas para el cabello con ionización",
                "Máquinas de coser electrónicas",
                "Robots de limpieza con sistema de navegación",
                "Sistemas de cocina inteligentes",
                "Sistemas de riego automatizados",
                "Sistemas de climatización central",
                "Sistemas de ventilación con filtro HEPA",
                "Sistemas de purificación de aire",
                "Sistemas de seguridad para puertas y ventanas",
                "Sistemas de videovigilancia para el hogar",
                "Sistemas de alarma contra incendios",
                "Sistemas de alarma para el hogar",
                "Sistemas de control de acceso para el hogar",
                "Sistemas de control de humedad",
                "Electrodomésticos de alta calidad a precios increíbles",
                "Consigue el mejor precio en electrodomésticos",
                "La tecnología más avanzada en electrodomésticos",
                "Los mejores electrodomésticos al mejor precio",
                "Nuevos electrodomésticos con garantía de fabricante",
                "Los electrodomésticos más populares de la temporada",
                "Los electrodomésticos más vendidos en un solo lugar",
                "Los electrodomésticos más novedosos del mercado",
                "Los mejores electrodomésticos para tu hogar",
                "Los electrodomésticos más buscados en stock",
                "Los electrodomésticos más innovadores del mercado",
                "Los electrodomésticos más eficientes en términos de energía",
                "Los electrodomésticos más duraderos del mercado",
                "Los electrodomésticos más fáciles de usar",
                "Los electrodomésticos más inteligentes del mercado",
                "Los electrodomésticos más estilizados del mercado",
                "Los electrodomésticos más modernos del mercado",
                "Los electrodomésticos más silenciosos del mercado",
                "Los electrodomésticos más potentes del mercado",
                "Los electrodomésticos más fiables del mercado"
            ]),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'detail' => $this->faker->randomElement([
                "Este refrigerador cuenta con una capacidad de almacenamiento de 550 litros, lo que lo hace ideal para grandes familias o para almacenar comida para fiestas. Además, cuenta con tecnología de enfriamiento dual que mantiene la comida fresca por más tiempo. También tiene un sistema de filtración de agua incorporado y una pantalla táctil para controlar la temperatura y programar alarmas.",
                "Esta lavadora cuenta con carga frontal, lo que la hace muy fácil de cargar y descargar. Además, cuenta con una eficiencia energética de clase A++, lo que ayudará a reducir tu factura de electricidad. También tiene un programa especial para prendas delicadas y un sistema de autolimpieza.",
                "Este horno eléctrico cuenta con una capacidad de 65 litros, lo que lo hace ideal para cocinar para grandes grupos de personas. Además, cuenta con programas automáticos para cocinar diferentes tipos de alimentos, como carnes, pescados y pasteles. También tiene un sistema de limpieza automática y una pantalla táctil para controlar la temperatura y programar alarmas.",
                "Esta cocina eléctrica cuenta con 4 quemadores de inducción, lo que la hace ideal para cocinar para grandes grupos de personas. Además, cuenta con un panel de control táctil y un temporizador para programar el tiempo de cocción. También tiene un sistema de seguridad que evita que los niños enciendan los quemadores.",
                "Este lavavajillas cuenta con una capacidad de 12 cubiertos, lo que lo hace ideal para cocinar para grandes grupos de personas. Además, cuenta con un sistema de limpieza automática y un sistema de filtración de agua incorporado. También tiene un sistema de autolimpieza y un temporizador para programar el tiempo de lavado.",
                "Este microondas cuenta con una capacidad de 20 litros, lo que lo hace ideal para cocinar para grandes grupos de personas. Además, cuenta con un sistema de descongelación automática y un temporizador para programar el tiempo de cocción. También tiene un sistema de limpieza automática y un panel de control táctil.",
                "Esta aspiradora cuenta con un sistema ciclónico de doble filtración, lo que la hace muy eficiente en la eliminación de polvo y alérgenos. Además, cuenta con una potencia de succión de 2000 vatios y un sistema de filtrado HEPA para personas alérgicas. También tiene un sistema de autolimpieza y un control remoto para programar alarmas.",
                "Esta plancha de ropa cuenta con un sistema de vapor de alta presión, lo que la hace muy eficiente en la eliminación de arrugas. Además, cuenta con una función de vapor vertical para planchar prendas colgadas y un sistema de auto limpieza. También tiene una pantalla táctil para controlar la temperatura y programar alarmas.",
                "Este secador de pelo cuenta con un motor de 2000 vatios, lo que lo hace muy potente y eficiente. Además, cuenta con 3 niveles de temperatura y 2 niveles de velocidad para adaptarse a diferentes tipos de cabello. También tiene un sistema de autolimpieza y un sistema de enfriamiento rápido.",
                "Este ventilador cuenta con 3 velocidades de ventilación, lo que lo hace ideal para diferentes tipos de ambientes. Además, cuenta con un sistema de oscilación automática y un temporizador para programar el tiempo de funcionamiento. También tiene un sistema de autolimpieza y un sistema de enfriamiento rápido.",
                "Esta licuadora cuenta con un motor de alta velocidad de 1000 vatios, lo que la hace muy potente para licuar cualquier tipo de fruta o verdura. Además, cuenta con un sistema de autolimpieza y un vaso de acero inoxidable de alta calidad. También tiene un control de velocidad variable y una pantalla táctil para programar alarmas.",
                "Esta batidora cuenta con accesorios incluidos como varillas para batir claras de huevo y una varilla para mezclar. Además, cuenta con un sistema de autolimpieza y un vaso medidor de acero inoxidable. También tiene un control de velocidad variable y una pantalla táctil para programar alarmas.",
                "Esta cafetera cuenta con una capacidad de 12 tazas, lo que la hace ideal para grandes grupos de personas. Además, cuenta con un sistema de autolimpieza y un temporizador para programar el tiempo de cocción. También tiene un sistema de autolimpieza y un panel de control táctil.",
                "Este hermoso y moderno refrigerador es el complemento perfecto para tu cocina de ensueño. Con su capacidad de almacenamiento de 550 litros, podrás guardar toda la comida y bebida que necesites para tus fiestas y reuniones con amigos y familiares. Además, cuenta con tecnología de enfriamiento dual para mantener tus alimentos frescos por más tiempo. ¡No te pierdas esta oportunidad de tener en tu hogar el mejor refrigerador del mercado!",
                "¿Estás cansado de lavadoras que no limpian tus prendas adecuadamente? ¡Con esta lavadora de carga frontal, eso será cosa del pasado! Su sistema de eficiencia energética de clase A++ te ayudará a ahorrar dinero en tu factura de electricidad, y su programa especial para prendas delicadas te asegurará que tus ropas favoritas estén siempre en perfectas condiciones. ¡No esperes más y hazte con esta lavadora hoy mismo!",
                "Este horno eléctrico es el sueño de cualquier chef. Con una capacidad de 65 litros, podrás cocinar para grandes grupos de personas y sorprender a tus invitados con tus habilidades culinarias. Además, cuenta con programas automáticos para cocinar diferentes tipos de alimentos, como carnes, pescados y pasteles. También tiene un sistema de limpieza automática y una pantalla táctil para controlar la temperatura y programar alarmas. ¡No esperes más y conviértete en el rey o reina de la cocina con este horno eléctrico!"
            ]),
            'stock' => $this->faker->randomDigit,
            'state_appliance' => $this->faker->randomElement(['nuevo', 'usado', 'reacondicionado', 'reparado', 'reacondicionado']),
            'address' => $this->faker->address,
            'phone' =>'09'.$this->faker->randomNumber(8),
            'delivery_method' => $this->faker->randomElement(['delivery', 'pickup']),
            'brand' => $this->faker->randomElement(['samsung', 'lg', 'sony', 'philips', 'panasonic', 'toshiba', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire', 'whirlpool', 'mabe', 'bosch', 'electrolux', 'general electric', 'haier', 'frigidaire']),
            'image' => $this->faker->randomElement([
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
