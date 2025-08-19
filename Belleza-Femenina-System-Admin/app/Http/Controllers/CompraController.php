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
   
    public function index()
    {
        $compras = Compra::all();
        return view('compra.index',compact('compras'));
    }

    
    public function create()
    {
        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();
        return view('compra.create',compact('productos'));
    }

    
   public function store(Request $request)
    {
        try {
            // Guardar compra
            $compra = Compra::create([
                'idEmpleado' => 1,
                'total' => $request->total,
                'fecha' => Carbon::now(),
            ]);

            // Decodificar detalles JSON
            $detalles = json_decode($request->detalles, true);
            

            // Guardar detalles y actualizar stock
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
                $variante = VariantesProducto::where('id_variantes', $detalle['idVarianteProducto'])->first();
                if ($variante) {
                    $variante->stock += $detalle['cantidad'];
                    $variante->save();
                }
            }
            return redirect()->route('compras.index')->with('success', 'Compra registrada exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}