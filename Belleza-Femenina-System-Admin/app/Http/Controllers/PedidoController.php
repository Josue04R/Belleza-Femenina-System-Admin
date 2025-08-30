<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Muestra una lista paginada de pedidos, priorizando los pendientes.
     *
     * @return \Illuminate\View\View Vista con la lista de pedidos.
     */
    public function index()
    {
        $pedidos = Pedido::with('cliente')
            ->orderByRaw("CASE WHEN estado = 'pendiente' THEN 0 ELSE 1 END")
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra los detalles de un pedido específico.
     *
     * @param int $id Identificador del pedido.
     * @return \Illuminate\View\View Vista con los datos del pedido.
     */
    public function show($id)
    {
        $pedido = Pedido::with('cliente', 'detalles.variante.producto', 'detalles.variante.talla')
            ->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Muestra el formulario para editar el estado y observaciones de un pedido.
     *
     * @param int $id Identificador del pedido.
     * @return \Illuminate\View\View Vista con el formulario de edición.
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    /**
     * Actualiza el estado y observaciones de un pedido.
     *
     * @param Request $request Petición HTTP con los datos actualizados.
     * @param int $id Identificador del pedido.
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->observaciones = $request->observaciones;
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Anula un pedido, cambia su estado a "cancelado" y restaura el stock.
     *
     * @param int $id Identificador del pedido.
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito.
     */
    public function anular($id)
    {
        $pedido = Pedido::with('detalles.variante')->findOrFail($id);

        foreach ($pedido->detalles as $detalle) {
            $detalle->variante->increment('stock', $detalle->cantidad);
        }

        $pedido->estado = 'cancelado';
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido cancelado correctamente y stock restaurado');
    }
}