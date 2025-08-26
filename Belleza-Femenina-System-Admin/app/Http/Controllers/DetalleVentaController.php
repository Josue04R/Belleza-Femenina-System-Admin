<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
   
    public function show(string $id)
    {
        $venta = Venta::with(['cliente', 'detalles.producto', 'detalles.variante'])
                  ->findOrFail($id);

        return view('detalleVenta.show', compact('venta'));
    }

   
}
