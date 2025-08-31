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
     * Muestra una lista paginada de variantes de productos con sus relaciones.
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de variantes.
     */
    public function index(Request $request): View
    {
        $variantesProductos = VariantesProducto::with(['producto', 'talla'])->orderBy('idVariante', 'asc')->paginate();

        return view('variantes-producto.index', compact('variantesProductos'))
            ->with('i', ($request->input('page', 1) - 1) * $variantesProductos->perPage());
    }

    /**
     * Muestra el formulario para crear una nueva variante de producto.
     *
     * @return View Vista con el formulario y listas de productos y tallas.
     */
    public function create(): View
    {
        $variantesProducto = new VariantesProducto();
        $productos = Producto::all();
        $tallas = Talla::all();

        return view('variantes-producto.create', compact('variantesProducto', 'productos', 'tallas'));
    }

    /**
     * Almacena una nueva variante de producto en la base de datos.
     *
     * @param VariantesProductoRequest $request Petición validada con los datos de la variante.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(VariantesProductoRequest $request): RedirectResponse
    {
        VariantesProducto::create($request->validated());

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto creada correctamente.');
    }

    /**
     * Muestra los detalles de una variante de producto específica.
     *
     * @param int $id Identificador de la variante.
     * @return View Vista con los datos de la variante.
     */
    public function show($id): View
    {
        $variantesProducto = VariantesProducto::find($id);

        return view('variantes-producto.show', compact('variantesProducto'));
    }

    /**
     * Muestra el formulario para editar una variante de producto existente.
     *
     * @param int $id Identificador de la variante.
     * @return View Vista con el formulario y listas de productos y tallas.
     */
    public function edit($id): View
    {
        $variantesProducto = VariantesProducto::findOrFail($id);
        $productos = Producto::all();
        $tallas = Talla::all();

        return view('variantes-producto.edit', compact('variantesProducto', 'productos', 'tallas'));
    }

    /**
     * Actualiza los datos de una variante de producto en la base de datos.
     *
     * @param VariantesProductoRequest $request Petición validada con los datos actualizados.
     * @param VariantesProducto $variantesProducto Instancia de la variante a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(VariantesProductoRequest $request, VariantesProducto $variantesProducto): RedirectResponse
    {
        $variantesProducto->update($request->validated());

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto actualizada correctamente.');
    }

    /**
     * Elimina una variante de producto de la base de datos.
     *
     * @param int $id Identificador de la variante.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        VariantesProducto::find($id)->delete();

        return Redirect::route('variantes-productos.index')
            ->with('success', 'Variantes-Producto eliminada correctamente.');
    }

    /**
     * Obtiene los datos de una variante de producto por ID de producto.
     *
     * @param int $id_producto Identificador del producto.
     * @return \Illuminate\Http\JsonResponse JSON con color, precio y stock o error.
     */
    public function getDatosProducto($idProdcuto)
    {
        $variante = VariantesProducto::where('idProducto', $idProdcuto)->first();

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