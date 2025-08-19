<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
     
    public function show($id){
        $compra = Compra::with(['detalles.variante.producto'])->findOrFail($id);
        return view('detalleCompras.show', compact('compra'));
    }
}