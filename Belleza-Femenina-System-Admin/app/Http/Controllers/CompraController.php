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
        return view('compra.index');
    }

    
    public function create()
    {
        $productos = \App\Models\Producto::with('variantesProductos.talla')->get();
        return view('compra.create',compact('productos'));
    }

    
   public function store(Request $request)
    {
        DB::beginTransaction();
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

                $variante = VariantesProducto::find($detalle['idVarianteProducto']);
                if ($variante) {
                    $variante->stock += $detalle['cantidad'];
                    $variante->save();
                }
            }

            DB::commit();
            return redirect()->route('compras.index')->with('success', 'Compra registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
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