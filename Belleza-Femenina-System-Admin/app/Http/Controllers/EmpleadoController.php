<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoRequest;
use App\Models\Permiso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contrasenia' => 'required|string',
        ]);

        $empleado = Empleado::where('usuario', $request->usuario)
                            ->where('contrasenia', $request->contrasenia)
                            ->first();

        if ($empleado) {
           
            session([
                'empleado_id' => $empleado->idEmpleado,
                'empleado_nombre' => $empleado->nombre,
                'empleado_apellido' => $empleado->apellido,
            ]);
            return redirect()->route('panel')->with('success', 'Bienvenido '.$empleado->nombre);
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }


    public function index(Request $request): View
    {
        $empleados = Empleado::paginate();

        return view('empleado.index', compact('empleados'))
            ->with('i', ($request->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permisos = Permiso::all();
        $empleado = new Empleado();

        return view('empleado.create', compact('empleado','permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleadoRequest $request): RedirectResponse
    {
        Empleado::create($request->validated());

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $empleado = Empleado::find($id);

        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {   
        $permisos = Permiso::all();
        $empleado = Empleado::find($id);

        return view('empleado.edit', compact('empleado','permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        $empleado->update($request->validated());

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Modificado');
    }

    public function destroy($id): RedirectResponse
    {
        Empleado::find($id)->delete();

        return Redirect::route('empleados.index')
            ->with('success', 'Empleado Eliminado');
    }
}
