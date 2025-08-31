<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoRequest;
use App\Models\Permiso;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmpleadoController extends Controller
{
    /**
     * Autentica al empleado usando usuario y contraseña.
     *
     * @param Request $request Datos de la petición HTTP.
     * @return RedirectResponse Redirección al panel si es exitoso, o de vuelta con error.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'usuario' => 'required|string',
            'contrasenia' => 'required|string',
        ]);

        $empleado = Empleado::where('usuario', $request->usuario)->first();

        if ($empleado && Hash::check($request->contrasenia, $empleado->contrasenia)) {
            session([
                'empleado_id' => $empleado->idEmpleado,
                'empleado_nombre' => $empleado->nombre,
                'empleado_apellido' => $empleado->apellido,
            ]);
            return redirect()->route('panel')->with('success', 'Bienvenido '.$empleado->nombre);
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }

    /**
     * Muestra una lista paginada de empleados.
     *
     * @param Request $request Petición HTTP con parámetros de paginación.
     * @return View Vista con la lista de empleados.
     */
    public function index(Request $request): View
    {
        $empleados = Empleado::paginate();

        return view('empleado.index', compact('empleados'))
            ->with('i', ($request->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo empleado.
     *
     * @return View Vista con el formulario y lista de permisos.
     */
    public function create(): View
    {
        $permisos = Permiso::all();
        $empleado = new Empleado();

        return view('empleado.create', compact('empleado', 'permisos'));
    }

    /**
     * Almacena un nuevo empleado en la base de datos.
     *
     * @param EmpleadoRequest $request Petición validada con los datos del empleado.
     * @return RedirectResponse Redirección a la lista con mensaje de éxito.
     */
    public function store(EmpleadoRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Encriptar la contraseña antes de guardar
        $data['contrasenia'] = Hash::make($data['contrasenia']);

        Empleado::create($data);

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Creado');
    }

    /**
     * Muestra los detalles de un empleado específico.
     *
     * @param int $id Identificador del empleado.
     * @return View Vista con los datos del empleado.
     */
    public function show($id): View
    {
        $empleado = Empleado::find($id);

        return view('empleado.show', compact('empleado'));
    }

    /**
     * Muestra el formulario para editar un empleado existente.
     *
     * @param int $id Identificador del empleado.
     * @return View Vista con el formulario y lista de permisos.
     */
    public function edit($id): View
    {
        $permisos = Permiso::all();
        $empleado = Empleado::find($id);

        return view('empleado.edit', compact('empleado', 'permisos'));
    }

    /**
     * Actualiza los datos de un empleado en la base de datos.
     *
     * @param EmpleadoRequest $request Petición validada con los datos actualizados.
     * @param Empleado $empleado Instancia del empleado a modificar.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function update(EmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        $data = $request->validated();

        // Solo encriptar si viene nueva contraseña
        if (!empty($data['contrasenia'])) {
            $data['contrasenia'] = Hash::make($data['contrasenia']);
        } else {
            unset($data['contrasenia']); // para no sobreescribir la existente
        }

        $empleado->update($data);

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Modificado');
    }

    /**
     * Elimina un empleado de la base de datos.
     *
     * @param int $id Identificador del empleado.
     * @return RedirectResponse Redirección con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Empleado::find($id)->delete();

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Eliminado');
    }

    public function logout()
    {
        session()->flush(); // Limpia todas las variables de sesión
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }


}