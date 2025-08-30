<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClienteController extends Controller
{
    /**
     * Muestra una lista paginada de clientes.
     *
     * @param Request $request Datos de la petición HTTP, incluyendo la página actual.
     * @return View Vista con la lista de clientes y el índice de paginación.
     */
    public function index(Request $request): View
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', ($request->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     *
     * @return View Vista con el formulario de creación.
     */
    public function create(): View
    {
        $cliente = new Cliente();

        return view('cliente.create', compact('cliente'));
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     *
     * @param ClienteRequest $request Petición validada con los datos del nuevo cliente.
     * @return RedirectResponse Redirección a la lista de clientes con mensaje de éxito.
     */
    public function store(ClienteRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Encriptar la contraseña antes de guardar
        $data['password'] = bcrypt($data['password']);

        Cliente::create($data);

        return Redirect::route('clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Muestra los detalles de un cliente específico.
     *
     * @param int $id Identificador del cliente.
     * @return View Vista con los datos del cliente.
     */
    public function show($id): View
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     *
     * @param int $id Identificador del cliente.
     * @return View Vista con el formulario de edición.
     */
    public function edit($id): View
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Actualiza los datos de un cliente en la base de datos.
     *
     * @param ClienteRequest $request Petición validada con los datos actualizados.
     * @param Cliente $cliente Instancia del cliente a actualizar.
     * @return RedirectResponse Redirección a la lista de clientes con mensaje de éxito.
     */
    public function update(ClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $data = $request->validated();

        // Encriptar la contraseña solo si se proporciona
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $cliente->update($data);

        return Redirect::route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente de la base de datos.
     *
     * @param int $id Identificador del cliente.
     * @return RedirectResponse Redirección a la lista de clientes con mensaje de éxito.
     */
    public function destroy($id): RedirectResponse
    {
        Cliente::find($id)->delete();

        return Redirect::route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}