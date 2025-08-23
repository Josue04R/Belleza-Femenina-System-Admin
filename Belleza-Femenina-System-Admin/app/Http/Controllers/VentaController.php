<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\VariantesProducto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('detalles.producto', 'empleado')->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Decodificar JSON de productos
            $productos = json_decode($request->productos, true);

            if (!$productos || count($productos) === 0) {
                return back()->with('error', 'No hay productos para guardar.');
            }

            $totalVenta = 0;
            $detalleIds = [];

            // Primero guardamos todos los detalles de venta
            foreach ($productos as $producto) {
                $sub_total = $producto['subtotal'];
                DetalleVenta::create([
                    'venta_id'       => 0, // temporal, se actualizará luego
                    'producto_id'    => $producto['producto_id'],
                    'variante_id'    => $producto['id_variante'] ?? null,
                    'cantidad'       => $producto['cantidad'],
                    'precio_unitario'=> $producto['precio'],
                    'sub_total'      => $sub_total,
                ]);

                // Restar stock de la variante
                if (!empty($producto['id_variante'])) {
                    $variante = VariantesProducto::find($producto['id_variante']);
                    if ($variante) {
                        $variante->stock -= $producto['cantidad'];
                        $variante->save();
                    }
                }

                $totalVenta += $sub_total;
                $detalleIds[] = $detalle->id;
            }

            // Ahora creamos la venta principal
            $venta = Venta::create([
                'fecha'       => Carbon::now(),
                'total'       => $totalVenta,
                'empleado_id' => $request->empleado_id ?? 1,
                'user_id'     => $request->user_id ?? 1,
            ]);

            // Actualizamos los detalles con el id de la venta creada
            DetalleVenta::whereIn('id', $detalleIds)->update(['venta_id' => $venta->idVenta]);

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar la venta: ' . $e->getMessage());
        }
    }

}
