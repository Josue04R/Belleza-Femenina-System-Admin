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
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $gastosOperativos = GastosOperativo::paginate();

        return view('gastos-operativo.index', compact('gastosOperativos'))
            ->with('i', ($request->input('page', 1) - 1) * $gastosOperativos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    
        public function create()
    {
        $empleados = Empleado::select('idEmpleado','nombre','apellido')->orderBy('nombre')->get();
        $gastosOperativo = new GastosOperativo();
        return view('gastos-operativo.create', compact('empleados','gastosOperativo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GastosOperativoRequest $request): RedirectResponse
    {
        GastosOperativo::create($request->validated());

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $gastosOperativo = GastosOperativo::find($id);

        return view('gastos-operativo.show', compact('gastosOperativo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GastosOperativo $gastosOperativo)
    {
        $empleados = Empleado::select('idEmpleado','nombre','apellido')->orderBy('nombre')->get();
        return view('gastos-operativo.edit', compact('empleados','gastosOperativo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GastosOperativoRequest $request, GastosOperativo $gastosOperativo): RedirectResponse
    {
        $gastosOperativo->update($request->validated());

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        GastosOperativo::find($id)->delete();

        return Redirect::route('gastos-operativos.index')
            ->with('success', 'Gasto Operativo eliminado correctamente.');
    }
}
