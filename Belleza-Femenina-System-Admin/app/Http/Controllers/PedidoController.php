<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Muestra una lista paginada de pedidos, con filtro por estado y búsqueda por cliente.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Pedido::with('cliente');

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Buscador por cliente insensible a mayúsculas
        if ($request->filled('cliente')) {
            $cliente = strtolower($request->cliente);
            $query->whereHas('cliente', function($q) use ($cliente) {
                $q->whereRaw('LOWER(nombre) LIKE ?', ["%{$cliente}%"]);
            });
        }

        // Filtro por fecha
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        // Ordenar primero pendientes, luego por fecha
        $pedidos = $query
            ->orderByRaw("CASE WHEN estado = 'pendiente' THEN 0 ELSE 1 END")
            ->orderBy('fecha', 'desc')
            ->paginate(10)
            ->appends($request->all()); // Mantener filtros al paginar

        return view('pedidos.index', compact('pedidos'));
    }


    /**
     * Muestra los detalles de un pedido específico.
     */
    public function show($id)
    {
        $pedido = Pedido::with('cliente', 'detalles.variante.producto', 'detalles.variante.talla')
            ->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Muestra el formulario para editar un pedido.
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    /**
     * Actualiza estado y observaciones de un pedido.
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
     * Anula un pedido y restaura el stock.
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
