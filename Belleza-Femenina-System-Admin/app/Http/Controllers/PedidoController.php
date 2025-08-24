<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Listado de pedidos con paginación, pendientes primero
    public function index()
    {
        $pedidos = Pedido::with('cliente') // Trae info del cliente
            ->orderByRaw("CASE WHEN estado = 'pendiente' THEN 0 ELSE 1 END")
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    // Detalle de un pedido
    public function show($id)
    {
        $pedido = Pedido::with('cliente', 'detalles.variante.producto', 'detalles.variante.talla')
            ->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }

    // Editar pedido (solo estado y observaciones)
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    // Actualizar estado y observaciones
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->observaciones = $request->observaciones;
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');
    }

    // Anular pedido (cambia estado a "cancelado" y restaura stock)
    public function anular($id)
    {
        $pedido = Pedido::with('detalles.variante')->findOrFail($id);

        // Restaurar stock de los productos
        foreach ($pedido->detalles as $detalle) {
            $detalle->variante->increment('stock', $detalle->cantidad);
        }

        // Cambiar estado a "cancelado"
        $pedido->estado = 'cancelado';
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido cancelado correctamente y stock restaurado');
    }
}
