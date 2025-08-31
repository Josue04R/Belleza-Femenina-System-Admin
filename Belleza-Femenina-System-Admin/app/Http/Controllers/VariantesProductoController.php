<?php

namespace App\Http\Controllers;

use App\Models\VariantesProducto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VariantesProductoRequest;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VariantesProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $variantesProductos = VariantesProducto::with(['producto', 'talla'])->paginate();

        return view('variantes-producto.index', compact('variantesProductos'))
            ->with('i', ($request->input('page', 1) - 1) * $variantesProductos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $variantesProducto = new VariantesProducto();
        $productos = Producto::all();
        $tallas = Talla::all();  

        return view('variantes-producto.create', compact('variantesProducto', 'productos', 'tallas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VariantesProductoRequest $request): RedirectResponse
    {
        VariantesProducto::create($request->validated());

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $variantesProducto = VariantesProducto::find($id);

        return view('variantes-producto.show', compact('variantesProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $variantesProducto = VariantesProducto::findOrFail($id); 
        $productos = Producto::all();
        $tallas = Talla::all();

        return view('variantes-producto.edit', compact('variantesProducto', 'productos', 'tallas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VariantesProductoRequest $request, VariantesProducto $variantesProducto): RedirectResponse
    {
        $variantesProducto->update($request->validated());

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto actualizada correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        VariantesProducto::find($id)->delete();

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto elimnada correctamente.');
    }

    public function getDatosProducto($id_producto)
    {
        $variante = VariantesProducto::where('idProducto', $id_producto)->first();

        if (!$variante) {
            return response()->json(['error' => 'Variante no encontrada'], 404);
        }

        return response()->json([
            'color' => $variante->color,
            'precio' => $variante->precio,
            'stock' => $variante->stock,
        ]);
    }

}
