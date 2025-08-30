<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LogRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LogController extends Controller
{
    /**
     * Muestra una lista paginada de registros (logs).
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de logs.
     */
    public function index(Request $request): View
    {
        $logs = Log::paginate();

        return view('log.index', compact('logs'))
            ->with('i', ($request->input('page', 1) - 1) * $logs->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo log.
     *
     * @return View Vista con el formulario de creación.
     */
    public function create(): View
    {
        $log = new Log();

        return view('log.create', compact('log'));
    }

    /**
     * Almacena un nuevo log en la base de datos.
     *
     * @param LogRequest $request Petición validada con los datos del log.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(LogRequest $request): RedirectResponse
    {
        Log::create($request->validated());

        return Redirect::route('logs.index')
            ->with('success', 'Log created successfully.');
    }

    /**
     * Muestra los detalles de un log específico.
     *
     * @param int $id Identificador del log.
     * @return View Vista con los datos del log.
     */
    public function show($id): View
    {
        $log = Log::find($id);

        return view('log.show', compact('log'));
    }

    /**
     * Muestra el formulario para editar un log existente.
     *
     * @param int $id Identificador del log.
     * @return View Vista con el formulario de edición.
     */
    public function edit($id): View
    {
        $log = Log::find($id);

        return view('log.edit', compact('log'));
    }

    /**
     * Actualiza los datos de un log en la base de datos.
     *
     * @param LogRequest $request Petición validada con los datos actualizados.
     * @param Log $log Instancia del log a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(LogRequest $request, Log $log): RedirectResponse
    {
        $log->update($request->validated());

        return Redirect::route('logs.index')
            ->with('success', 'Log updated successfully');
    }

    /**
     * Elimina un log de la base de datos.
     *
     * @param int $id Identificador del log.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Log::find($id)->delete();

        return Redirect::route('logs.index')
            ->with('success', 'Log deleted successfully');
    }
}