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

    public function create(): View
    {
        $producto = new Producto();
        $categorias = Categoria::all();

        return view('producto.create', compact('producto', 'categorias'));
    }

    public function store(ProductoRequest $request, SupabaseService $supabase)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = 'productos/' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Subir a Supabase
            $supabase->uploadFile($path, file_get_contents($file), $file->getMimeType());

            // Guardar URL pública en DB
            $data['imagen'] = $supabase->getPublicUrl($path);
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show($id): View
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    public function edit($id): View
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); 
        return view('producto.edit', compact('producto', 'categorias'));
    }

    public function update(ProductoRequest $request, Producto $producto): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = 'productos/' . uniqid() . '.' . $file->getClientOriginalExtension();

            $supabase = app(SupabaseService::class);
            $supabase->uploadFile($path, file_get_contents($file), $file->getMimeType());

            // Guardar URL pública
            $data['imagen'] = $supabase->getPublicUrl($path);
        }

        $producto->update($data);

        return Redirect::route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Producto::findOrFail($id)->delete();
        return Redirect::route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
