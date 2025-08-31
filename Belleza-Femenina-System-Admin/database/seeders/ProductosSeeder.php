<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\VariantesProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['categoria' => 'Reductoras', 'descripcion' => 'Fajas colombianas reductoras de alta compresión'],
            ['categoria' => 'Postparto', 'descripcion' => 'Fajas colombianas para recuperación postparto'],
            ['categoria' => 'Deportivas', 'descripcion' => 'Fajas colombianas para entrenamientos y deporte'],
            ['categoria' => 'Modeladoras', 'descripcion' => 'Fajas colombianas para moldear y definir la figura'],
        ];

        foreach ($categorias as $cat) {
        }

        $tallas = ['S', 'M', 'L', 'XL'];

        foreach ($tallas as $t) {
            Talla::create(['talla' => $t]);
        }

        $productos = [
            ['Faja Colombiana Cintura Alta', 'Moldeate', 1, 'Látex y algodón', 'Faja reductora colombiana con compresión alta', 34.99, 'activo'],
            ['Faja Colombiana Body Completo', 'SlimWear', 4, 'Microfibra', 'Faja body colombiana con tirantes ajustables', 49.00, 'activo'],
            ['Faja Colombiana Deportiva', 'SportShape', 3, 'Neopreno', 'Faja chaleco deportiva para sudoración', 36.50, 'activo'],
            ['Faja Colombiana Postparto Soporte', 'FitMama', 2, 'Algodón', 'Faja postparto colombiana con soporte lumbar', 42.00, 'activo'],
            ['Faja Colombiana Chaleco', 'BodyForm', 4, 'Látex', 'Faja chaleco colombiana moldeadora', 45.50, 'activo'],
        ];
        
        $productosCreados = [];
        foreach ($productos as $p) {
            $producto = Producto::create([
                'nombreProducto'  => $p[0],
                'marcaProducto'   => $p[1],
                'idCategoria'     => $p[2],
                'material'        => $p[3],
                'descripcion'     => $p[4],
                'precio'          => $p[5],
                'imagen'          => null, 
                'estado'          => $p[6],
            ]);
            $productosCreados[] = $producto;
        }

        $colores = ['Negro', 'Beige', 'Blanco', 'Café'];

        $tallasBD = Talla::all();
        foreach ($productosCreados as $producto) {
            foreach ($tallasBD as $talla) {
                foreach ($colores as $color) {
                    VariantesProducto::create([
                        'idProducto' => $producto->idProducto,
                        'idTalla'    => $talla->idTalla,
                        'color'      => $color,
                        'stock'      => rand(5, 20),
                        'precio'     => $producto->precio,
                    ]);
                }
            }
        }
    }
}
