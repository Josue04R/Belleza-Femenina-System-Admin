<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TallaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TallaController extends Controller
{
    /**
     * Muestra una lista paginada de tallas.
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de tallas.
     */
    public function index(Request $request): View
    {
        $tallas = Talla::paginate();

        return view('talla.index', compact('tallas'))
            ->with('i', ($request->input('page', 1) - 1) * $tallas->perPage());
    }

    /**
     * Muestra el formulario para crear una nueva talla.
     *
     * @return View Vista con el formulario de creación.
     */
    public function create(): View
    {
        $talla = new Talla();

        return view('talla.create', compact('talla'));
    }

    /**
     * Almacena una nueva talla en la base de datos.
     *
     * @param TallaRequest $request Petición validada con los datos de la talla.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(TallaRequest $request): RedirectResponse
    {
        Talla::create($request->validated());

        return Redirect::route('tallas.index')
            ->with('success', 'Talla creada correctamente.');
    }

    /**
     * Muestra los detalles de una talla específica.
     *
     * @param int $id Identificador de la talla.
     * @return View Vista con los datos de la talla.
     */
    public function show($id): View
    {
        $talla = Talla::find($id);

        return view('talla.show', compact('talla'));
    }

    /**
     * Muestra el formulario para editar una talla existente.
     *
     * @param int $id Identificador de la talla.
     * @return View Vista con el formulario de edición.
     */
    public function edit($id): View
    {
        $talla = Talla::find($id);

        return view('talla.edit', compact('talla'));
    }

    /**
     * Actualiza los datos de una talla en la base de datos.
     *
     * @param TallaRequest $request Petición validada con los datos actualizados.
     * @param Talla $talla Instancia de la talla a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(TallaRequest $request, Talla $talla): RedirectResponse
    {
        $talla->update($request->validated());

        return Redirect::route('tallas.index')
            ->with('success', 'Talla actualizada correctamente.');
    }

    /**
     * Elimina una talla de la base de datos.
     *
     * @param int $id Identificador de la talla.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Talla::find($id)->delete();

        return Redirect::route('tallas.index')
            ->with('success', 'Talla eliminada correctamente.');
    }
}