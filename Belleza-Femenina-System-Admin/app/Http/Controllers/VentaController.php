<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\VariantesProducto;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::with('detalles.producto', 'usuario', 'empleado')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Formulario nueva venta
    public function create()
    {
        $productos = Producto::with('variantesProductos.talla')->get();
        return view('ventas.create', compact('productos'));
    }

    // Guardar venta
    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id_producto',
            'productos.*.id_variante' => 'required|exists:variantes_productos,id_variantes',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio' => 'required|numeric',
        ]);

        $venta = Venta::create([
            'user_id' => Auth::id() ?? 1,
            'empleado_id' => 1,
            'fecha' => Carbon::now(),
            'total' => 0
        ]);

        $total = 0;

        foreach ($request->productos as $item) {
            $variante = VariantesProducto::find($item['id_variante']);
            if (!$variante) return back()->withErrors('Variante no encontrada');

            $subtotal = $item['cantidad'] * $item['precio'];

            DetalleVenta::create([
                'venta_id' => $venta->idVenta,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);

            $variante->stock -= $item['cantidad'];
            $variante->save();

            $total += $subtotal;
        }

        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }
}
