<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PermisoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PermisoController extends Controller
{
    /**
     * Muestra una lista paginada de permisos.
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de permisos.
     */
    public function index(Request $request): View
    {
        $permisos = Permiso::paginate();

        return view('permiso.index', compact('permisos'))
            ->with('i', ($request->input('page', 1) - 1) * $permisos->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo permiso.
     *
     * @return View Vista con el formulario de creación.
     */
    public function create(): View
    {
        $permiso = new Permiso();

        return view('permiso.create', compact('permiso'));
    }

    /**
     * Almacena un nuevo permiso en la base de datos.
     *
     * @param PermisoRequest $request Petición validada con los datos del permiso.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(PermisoRequest $request): RedirectResponse
    {
        Permiso::create($request->validated());

        return Redirect::route('permisos.index')
            ->with('success', 'Permiso Creado');
    }

    /**
     * Muestra los detalles de un permiso específico.
     *
     * @param int $id Identificador del permiso.
     * @return View Vista con los datos del permiso.
     */
    public function show($id): View
    {
        $permiso = Permiso::find($id);

        return view('permiso.show', compact('permiso'));
    }

    /**
     * Muestra el formulario para editar un permiso existente.
     *
     * @param int $id Identificador del permiso.
     * @return View Vista con el formulario de edición.
     */
    public function edit($id): View
    {
        $permiso = Permiso::find($id);

        return view('permiso.edit', compact('permiso'));
    }

    /**
     * Actualiza los datos de un permiso en la base de datos.
     *
     * @param PermisoRequest $request Petición validada con los datos actualizados.
     * @param Permiso $permiso Instancia del permiso a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(PermisoRequest $request, Permiso $permiso): RedirectResponse
    {
        $permiso->update($request->validated());

        return Redirect::route('permisos.index')
            ->with('success', 'Permiso Modificado');
    }

    /**
     * Elimina un permiso de la base de datos.
     *
     * @param int $id Identificador del permiso.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Permiso::find($id)->delete();

        return Redirect::route('permisos.index')
            ->with('success', 'Permiso Eliminado');
    }
}