<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'nombrePermiso' => 'required|string',
			'gestionProductos' => 'boolean',
			'empleados' => 'boolean',
			'permisos' => 'boolean',
			'registroVentas' => 'boolean',
			'ventas' => 'boolean',
			'compras' => 'boolean',
			'pedidos' => 'boolean',
			'gastosOperativos' => 'boolean',
			'inventario' => 'boolean',
			'clientes' => 'boolean',
        ];
    }
}
