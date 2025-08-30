<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductoController extends Controller
{
    /**
     * Muestra una lista paginada de productos, con búsqueda opcional.
     *
     * @param Request $request Petición HTTP con parámetros de búsqueda y paginación.
     * @return View|string Vista con la lista de productos o HTML renderizado si es AJAX.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $productos = Producto::query()
            ->when($search, function($query, $search) {
                $search = strtolower($search);
                $query->whereRaw('LOWER(nombre_p) LIKE ?', ["%{$search}%"]);
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('producto._tabla', compact('productos'))->render();
        }

        return view('producto.index', compact('productos'))
            ->with('i', ($request->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return View Vista con el formulario y lista de categorías.
     */
    public function create(): View
    {
        $producto = new Producto();
        $categorias = Categoria::all();

        return view('producto.create', compact('producto', 'categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos, incluyendo imagen en Supabase.
     *
     * @param ProductoRequest $request Petición validada con los datos del producto.
     * @param SupabaseService $supabase Servicio para subir archivos a Supabase.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(ProductoRequest $request, SupabaseService $supabase): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = 'productos/' . uniqid() . '.' . $file->getClientOriginalExtension();

            $supabase->uploadFile($path, file_get_contents($file), $file->getMimeType());
            $data['imagen'] = $supabase->getPublicUrl($path);
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param int $id Identificador del producto.
     * @return View Vista con los datos del producto.
     */
    public function show($id): View
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param int $id Identificador del producto.
     * @return View Vista con el formulario y lista de categorías.
     */
    public function edit($id): View
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza los datos de un producto en la base de datos, incluyendo imagen en Supabase.
     *
     * @param ProductoRequest $request Petición validada con los datos actualizados.
     * @param Producto $producto Instancia del producto a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(ProductoRequest $request, Producto $producto): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = 'productos/' . uniqid() . '.' . $file->getClientOriginalExtension();

            $supabase = app(SupabaseService::class);
            $supabase->uploadFile($path, file_get_contents($file), $file->getMimeType());
            $data['imagen'] = $supabase->getPublicUrl($path);
        }

        $producto->update($data);

        return Redirect::route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id Identificador del producto.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Producto::findOrFail($id)->delete();
        return Redirect::route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}