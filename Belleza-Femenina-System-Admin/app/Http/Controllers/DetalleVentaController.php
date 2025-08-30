<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Muestra los detalles de una venta específica, incluyendo cliente,
     * productos vendidos, variantes y cantidades.
     *
     * @param string $id Identificador único de la venta.
     * @return \Illuminate\View\View Vista con los detalles completos de la venta.
     */
    public function show(string $id)
    {
        $venta = Venta::with(['cliente', 'detalles.producto', 'detalles.variante'])
                      ->findOrFail($id);

        return view('detalleVenta.show', compact('venta'));
    }
}