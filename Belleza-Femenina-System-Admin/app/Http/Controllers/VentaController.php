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
    /**
     * Muestra una lista de ventas ordenadas por fecha descendente.
     *
     * @return \Illuminate\View\View Vista con el listado de ventas.
     */
    public function index()
    {
        $ventas = Venta::orderBy('fecha', 'desc')->get();

        return view('ventas.index', compact('ventas'));
    }

    /**
     * Muestra el formulario para registrar una nueva venta.
     *
     * @return \Illuminate\View\View Vista con productos y clientes disponibles.
     */
    public function create()
    {
        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();
        $clientes = \App\Models\Cliente::all();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    /**
     * Registra una nueva venta en la base de datos, incluyendo sus detalles
     * y actualiza el stock de las variantes de producto.
     *
     * @param Request $request Petición HTTP con los datos de la venta.
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito o error.
     */
    public function store(Request $request)
    {
        $empleadoId = session('empleado_id');
        $idCliente = $request->idCliente;
        $detalles = json_decode($request->detalles, true);

        if (!$detalles || count($detalles) === 0) {
            return redirect()->back()->with('error', 'Debe agregar al menos un producto a la venta.');
        }

        $venta = Venta::create([
            'idEmpleado' => $empleadoId,
            'idCliente' => $idCliente,
            'total' => $request->total,
            'fecha' => Carbon::now(),
        ]);

        foreach ($detalles as $detalle) {
            $variante = VariantesProducto::find($detalle['idVarianteProducto']);

            if (!$variante) {
                return redirect()->back()->with('error', 'Variante no encontrada.');
            }

            if ($variante->stock < $detalle['cantidad']) {
                
                return redirect()->back()->with('error', "No hay suficiente stock para {$variante->producto->nombreProducto} ({$variante->color} / {$variante->talla->talla}). Disponible: {$variante->stock}");
            }

            DetalleVenta::create([
                'idVenta' => $venta->idVenta,
                'idProducto' => $detalle['idProducto'],
                'idVariante' => $detalle['idVarianteProducto'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
                'subTotal' => $detalle['subtotal'],
            ]);

            $variante->stock -= $detalle['cantidad'];
            $variante->save();
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    }
}