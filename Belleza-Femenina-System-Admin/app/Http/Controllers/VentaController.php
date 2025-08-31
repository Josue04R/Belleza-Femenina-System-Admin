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
        $ventas = Venta::orderBy('fecha', 'desc')->get();

        return view('ventas.index', compact('ventas'));
       
    }

    public function create()
    {

        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();

        $clientes = \App\Models\Cliente::all();
        // Retornar la vista con productos y clientes
        return view('ventas.create', compact('productos', 'clientes'));
    }

    public function store(Request $request)
    {
        $empleadoId = session('empleado_id');

        $idCliente = $request->idCliente;

        $detalles = json_decode($request->detalles, true);

        if (!$detalles || count($detalles) === 0) {
            return redirect()->back()->with('error', 'Debe agregar al menos un producto a la venta.');
        }

       
        // Crear la venta
        $venta = Venta::create([
            'idEmpleado' => $empleadoId,
            'idCliente' => $idCliente,
            'total' => $request->total,
            'fecha' => Carbon::now(),
        ]);

        // Guardar detalles y disminuir stock
        foreach ($detalles as $detalle) {
            $variante = VariantesProducto::find($detalle['idVarianteProducto']);

            if (!$variante) {
                
                return redirect()->back()->with('error', 'Variante no encontrada.');
            }

            if ($variante->stock < $detalle['cantidad']) {
                
                return redirect()->back()->with('error', "No hay suficiente stock para {$variante->producto->nombreProducto} ({$variante->color} / {$variante->talla->talla}). Disponible: {$variante->stock}");
            }

            // Crear detalle
            DetalleVenta::create([
                'idVenta' => $venta->idVenta,
                'idProducto' => $detalle['idProducto'],
                'idVariante' => $detalle['idVarianteProducto'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
                'subTotal' => $detalle['subtotal'],
            ]);

            // Disminuir stock
            $variante->stock -= $detalle['cantidad'];
            $variante->save();
        }

        
        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');

       
    }

}
