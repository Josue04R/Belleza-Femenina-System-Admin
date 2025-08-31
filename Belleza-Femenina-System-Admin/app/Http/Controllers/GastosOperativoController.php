<?php

namespace App\Http\Controllers;

use App\Models\GastosOperativo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GastosOperativoRequest;
use App\Models\Empleado;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GastosOperativoController extends Controller
{
    /**
     * Muestra una lista paginada de gastos operativos.
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de gastos operativos.
     */
    public function index(Request $request): View
    {
        $gastosOperativos = GastosOperativo::paginate();

        return view('gastos-operativo.index', compact('gastosOperativos'))
            ->with('i', ($request->input('page', 1) - 1) * $gastosOperativos->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo gasto operativo.
     *
     * @return View Vista con el formulario y lista de empleados.
     */
    public function create(): View
    {
        $empleados = Empleado::select('idEmpleado', 'nombre', 'apellido')->orderBy('nombre')->get();
        $gastosOperativo = new GastosOperativo();
        return view('gastos-operativo.create', compact('empleados', 'gastosOperativo'));
    }

    /**
     * Almacena un nuevo gasto operativo en la base de datos.
     *
     * @param GastosOperativoRequest $request Petición validada con los datos del gasto.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function store(GastosOperativoRequest $request): RedirectResponse
    {
        GastosOperativo::create($request->validated());

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo creado correctamente.');
    }

    /**
     * Muestra los detalles de un gasto operativo específico.
     *
     * @param int $id Identificador del gasto operativo.
     * @return View Vista con los datos del gasto.
     */
    public function show($id): View
    {
        $gastosOperativo = GastosOperativo::find($id);

        return view('gastos-operativo.show', compact('gastosOperativo'));
    }

    /**
     * Muestra el formulario para editar un gasto operativo existente.
     *
     * @param GastosOperativo $gastosOperativo Instancia del gasto operativo.
     * @return View Vista con el formulario y lista de empleados.
     */
    public function edit(GastosOperativo $gastosOperativo): View
    {
        $empleados = Empleado::select('idEmpleado', 'nombre', 'apellido')->orderBy('nombre')->get();
        return view('gastos-operativo.edit', compact('empleados', 'gastosOperativo'));
    }

    /**
     * Actualiza los datos de un gasto operativo en la base de datos.
     *
     * @param GastosOperativoRequest $request Petición validada con los datos actualizados.
     * @param GastosOperativo $gastosOperativo Instancia del gasto operativo a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(GastosOperativoRequest $request, GastosOperativo $gastosOperativo): RedirectResponse
    {
        $gastosOperativo->update($request->validated());

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo actualizado correctamente.');
    }

    /**
     * Elimina un gasto operativo de la base de datos.
     *
     * @param int $id Identificador del gasto operativo.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        GastosOperativo::find($id)->delete();

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo eliminado correctamente.');
    }
}