<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    /**
     * Muestra los detalles de una compra específica, incluyendo sus variantes y productos.
     *
     * @param int $id Identificador de la compra.
     * @return \Illuminate\View\View Vista con los detalles de la compra.
     */
    public function show($id){
        $compra = Compra::with(['detalles.variante.producto'])->findOrFail($id);
        return view('detalleCompras.show', compact('compra'));
    }
}