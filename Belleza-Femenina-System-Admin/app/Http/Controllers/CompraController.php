<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\VariantesProducto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Muestra una lista de todas las compras registradas.
     *
     * @return \Illuminate\View\View Vista con el listado de compras.
     */
    public function index()
    {
        $compras = Compra::all();
        return view('compra.index', compact('compras'));
    }

    /**
     * Muestra el formulario para registrar una nueva compra.
     *
     * @return \Illuminate\View\View Vista con los productos y variantes disponibles.
     */
    public function create()
    {
        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();
        return view('compra.create', compact('productos'));
    }

    /**
     * Registra una nueva compra en la base de datos, incluyendo sus detalles
     * y actualiza el stock de las variantes de producto.
     *
     * @param Request $request Petición HTTP con los datos de la compra.
     *                         Debe incluir 'total' y 'detalles' en formato JSON.
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista de compras con mensaje de éxito.
     */
    public function store(Request $request)
    {
        $empleadoId = session('empleado_id');

        $compra = Compra::create([
            'idEmpleado' => $empleadoId,
            'total' => $request->total,
            'fecha' => Carbon::now(),
        ]);

        // Decodificar detalles JSON
        $detalles = json_decode($request->detalles, true);

        // Guardar detalles de la compra
        foreach ($detalles as $detalle) {
            DetalleCompra::create([
                'idCompra' => $compra->idCompra,
                'idProducto' => $detalle['idProducto'],
                'idVarianteProducto' => $detalle['idVarianteProducto'],
                'cantidad' => $detalle['cantidad'],
                'subtotal' => $detalle['subtotal'],
            ]);
        }

        foreach ($detalles as $detalle){
            $variante = VariantesProducto::where('idVariante', $detalle['idVarianteProducto'])->first();
            if ($variante) {
                $variante->stock += $detalle['cantidad'];
                $variante->save();
            }
        }

        return redirect()->route('compras.index')->with('success', 'Compra registrada exitosamente.');
    }
}